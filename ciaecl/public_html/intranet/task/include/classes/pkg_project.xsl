<!DOCTYPE xsl:stylesheet  [
	<!ENTITY nbsp   "&#160;">
	<!ENTITY copy   "&#169;">
	<!ENTITY reg    "&#174;">
	<!ENTITY trade  "&#8482;">
	<!ENTITY mdash  "&#8212;">
	<!ENTITY ldquo  "&#8220;">
	<!ENTITY rdquo  "&#8221;"> 
	<!ENTITY pound  "&#163;">
	<!ENTITY yen    "&#165;">
	<!ENTITY euro   "&#8364;">
]><xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html"/>
<xsl:template match="/">
</html>
</xsl:template>
</xsl:stylesheet>
/****************************************************************************\
* TaskFreak!                                                                 *
* multi user                                                                 *
******************************************************************************
* Version: 0.6.1                                                             *
* Authors: Stan Ozier <stan@tirzen.net>                                      *
* License:  http://www.gnu.org/licenses/gpl.txt (GPL)                        *
******************************************************************************
* This file is part of &quot;TaskFreak! multi user&quot; program.                      *
*                                                                            *
* TaskFreak! multi user is free software; you can redistribute it and/or     *
* modify it under the terms of the GNU General Public License as published   *
* by the Free Software Foundation; either version 2 of the License, or (at   *  
* your option) any later version.                                            *
*                                                                            *
* TaskFreak! multi user is distributed in the hope that it will be           *
* useful, but WITHOUT ANY WARRANTY; without even the implied warranty of     *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the              *
* GNU General Public License for more details.                               *
*                                                                            *
* You should have received a copy of the GNU General Public License          *
* along with this program; if not, write to the Free Software                *
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA *
\****************************************************************************/

define('PRJ_DTE_NOW',strtotime(gmdate('Y-m-d',time()+Tzn::_getUserTZ())));

class ItemStatus extends TznDb
{
	
	function ItemStatus() {
		parent::TznDb('itemStatus');
		$this-&gt;addProperties(array(
			'id'			=&gt; 'UID',
			'itemId'		=&gt; 'NUM',
			'statusDate'	=&gt; 'DTM',
			'statusKey'		=&gt; 'NUM',
			'member'		=&gt; 'OBJ'
		));
	}
	
	function getStatus() {
		return $GLOBALS['langItemStatus'][$this-&gt;statusKey];
	}
	

    function add() {
        if (!$this-&gt;statusDate) {
            $this-&gt;setDtm('statusDate','NOW');
        }
        return parent::add();
    }
}


class ItemComplexList extends TznCollection
{
    function ItemComplexList() {
		parent::TznCollection($GLOBALS['langItemComplex']);
    }
}

class ItemUrgencyList extends TznCollection
{
    function ItemUrgencyList() {	
		parent::TznCollection($GLOBALS['langItemUrgency']);
    }	
}

class Item extends TznDb
{
	function Item()
	{
		parent::TznDb('item');
		$this-&gt;addProperties(array(
			'id'	 			=&gt; 'UID',
			'project'			=&gt; 'OBJ',
			'priority'			=&gt; 'NUM',
			'context'			=&gt; 'NUM',
			'title'				=&gt; 'STR',
			'description'		=&gt; 'BBS',
            'deadlineDate'      =&gt; 'DTE',
            'expectedDuration'  =&gt; 'NUM',
			'expectedUrgency'   =&gt; 'NUM',
			'expectedComplex'   =&gt; 'NUM',
			'showInCalendar'	=&gt; 'BOL',
			'showPrivate'   	=&gt; 'NUM',
            'member'            =&gt; 'OBJ',
            'authorId'          =&gt; 'NUM'
		));
		// default values
		$this-&gt;showPrivate = (defined('FRK_DEFAULT_VISIBILITY'))?FRK_DEFAULT_VISIBILITY:1;
	}

	function getItemCost($type='real',$format=true) {		
		if($type == 'real')
		{
			$this-&gt;getTimeStats($this-&gt;id,$this-&gt;member-&gt;id);	
			//$itemStatus = $this-&gt;itemStatus;print_r($this);
			$hour = round($this-&gt;itemTotalTimeSec/3600,2);
		}
		else
			$hour =  $this-&gt;expectedDuration;
		
		$objEditItem = new Project();
		$objEditItem-&gt;setUid($this-&gt;project-&gt;id);
		$objEditItem-&gt;load();
		
		$cost = $objEditItem-&gt;HHvalue * ($this-&gt;expectedComplex/100) * ($this-&gt;expectedUrgency/10) * $hour;
		
		if($format)
		{
			if($cost &gt; 0)
			{		return &quot;$&nbsp;&quot;.number_format($cost);		}
			else
			{	return '-'; }
		}
		else
			return $cost;
	}
		
    function getDescription() {
        $value = Tzn::_value('description');
		$value = preg_replace(&quot;/(?<!\")((http|ftp)+(s)?"
			.":\/\/[^<>\s]+)/i", "<a href=\"\\0\" target=\"_blank\">\\0</a>&quot;, $value);
		return nl2br($value);
    }

    function setStatus($status,$userId) {
        $objItemStatus = new ItemStatus();
        $objItemStatus-&gt;itemId = $this-&gt;id;
        $objItemStatus-&gt;member-&gt;id = $userId;
        $objItemStatus-&gt;statusKey = $status;
        $objItemStatus-&gt;add();
    }

    function getContext($mode=false) { // mode=0/short, 1/long
        $str = $GLOBALS['langItemContext'][$this-&gt;context];
		if ($mode) {
            return $str;
        } else {
			$color = $GLOBALS['confContext'][$this-&gt;context];
			if(trim($color) == '')
			{
				$color = '#FF9900';
			}
				
            return '<span style="background-color:'.$color.'" title="'.$str.'">'.substr($str,0,1).'</span>';
        }
	}
	
    function sameSame($objOld) {
        if ($this-&gt;priority == $objOld-&gt;priority
            &amp;&amp; $this-&gt;deadlineDate == $objOld-&gt;deadlineDate)
        {
            return true;
        } else {
            return false;
        }
    }

	function check() {
		$this-&gt;checkEmpty('title');
		if (!$this-&gt;priority) {
			$this-&gt;priority = 4;
		}
		if (!$this-&gt;deadlineDate) {
			$this-&gt;deadlineDate = '9999-00-00';
		}
		return (count($this-&gt;_error) == 0);
	}

    function getDir($pDir, $key='') {
		$fDir = ($key == 'deadline')?-$pDir:$pDir;
		if ($pDir == 1) {
			return 'ASC';
		} else {
			return 'DESC';
		}
	}

	function setOrder($pSort,$pDir) {
		switch($pSort) {
			case 'deadline';
				$this-&gt;addOrder('deadlineDate '.$this-&gt;getDir($pDir,'deadline')
					.', priority '.$this-&gt;getDir($pDir));
				break;
			case 'priority':
				$this-&gt;addOrder('priority '.$this-&gt;getDir($pDir)
					.', deadlineDate '.$this-&gt;getDir($pDir,'deadline'));
				break;
			default:
				$this-&gt;addOrder($pSort.' '.$this-&gt;getDir($pDir)
					.', deadlineDate ASC, priority ASC');
				break;
		}
	}

	function loadList($sql='') {
		if ($sql) {
			return parent::loadList(TZN_DB_COUNT_OFF,$sql);
		} else {
			$sql = 'SELECT ii.*, ';
			if (@constant('FRK_MYSQL_VERSION_GT_4_1')) {
				$sql .= 'iis.statusDate as itemStatus_statusDate, iis.statusKey as itemStatus_statusKey, ';
			} else {
				$sql .= 'SUBSTRING(MAX(CONCAT(iis.statusDate,iis.statusKey)),1,19) AS itemStatus_statusDate, '
					.'SUBSTRING(MAX(CONCAT(iis.statusDate,iis.statusKey)),20) AS itemStatus_statusKey, ';
			}
			$sql .= 'pp.name as project_name, '
				.'mm.title as member_title, mm.firstName as member_firstName, mm.middleName as member_middleName, '
				.'mm.lastName as member_lastName, mm.username as member_username';
			if ($userId) {
				$sql .= ', mp.position';
			}
			$sql .= ' FROM '.$this-&gt;gTable().' as ii '
				.'INNER JOIN '.$this-&gt;gTable('itemStatus').' AS iis ON ii.itemId = iis.itemId '
				.'LEFT JOIN '.$this-&gt;gTable('project').' AS pp ON ii.projectId = pp.projectId';
			if ($userId) {
				$sql .= ' LEFT JOIN '.$this-&gt;gTable('memberProject')
					.' AS mp ON ii.projectId = mp.projectId AND mp.memberId='.$userId;
			}
			$sql .= ' LEFT JOIN '.$this-&gt;gTable('member').' AS mm ON ii.memberId = mm.memberId ';
			$this-&gt;addGroup('ii.itemId');
			if (@constant('FRK_MYSQL_VERSION_GT_4_1')) {
				$this-&gt;addWhere('iis.statusDate=(SELECT MAX(iis2.statusDate) FROM '.$this-&gt;gTable('itemStatus')
					.' AS iis2 WHERE ii.itemId = iis2.itemId)');
			}

			return parent::loadList(TZN_DB_COUNT_AUTO,$sql);
		}
	}

	function delete() {
		if (parent::delete()) {
			$this-&gt;query('DELETE FROM '.$this-&gt;gTable('itemStatus').' WHERE itemId='.$this-&gt;id);
			$this-&gt;query('DELETE FROM '.$this-&gt;gTable('itemComment').' WHERE itemId='.$this-&gt;id);
			$this-&gt;query('DELETE FROM '.$this-&gt;gTable('itemFile').' WHERE itemId='.$this-&gt;id);
//--&gt; begin Time Clock addition
			$this-&gt;query('DELETE FROM '.$this-&gt;gTable('itemTimeClock').' WHERE itemId='.$this-&gt;id);
//&lt;-- end Time Clock addition
			return true;
		}
		return false;
	}
	
//--&gt; begin Time Clock addition
	function delete_time() {
	 	$table = &quot;itemTimeClock&quot;;
		if (parent::delete(&quot;&quot;,$table)) {
			$this-&gt;query('DELETE FROM '.$this-&gt;gTable($table).' WHERE itemId='.$this-&gt;id);
			return true;
		}
		return false;
	}
//&lt;-- end Time Clock addition	

}

class ItemStats extends Item
{
	function ItemStats()
	{
		parent::Item();
		$this-&gt;addProperties(array(
            'itemStatus'		=&gt; 'OBJ',
			'itemCommentCount'	=&gt; 'NUM',
			'itemFileCount'		=&gt; 'NUM',
//--&gt; begin Time Clock edit
            'position'          =&gt; 'NUM',
            'itemTotalTime'		=&gt; 'STR',
            'itemTotalTimeSec'	=&gt; 'NUM',            
            'itemClockId'		=&gt; 'NUM',
            'itemClockRunning'  =&gt; 'NUM'
//&lt;-- end Time Clock edit            
		));
	}

    function getDeadline($short=false) {
        if (ereg('(9999|0000)',$this-&gt;deadlineDate)) {
			return '-';
		} else {
			$dead = strtotime($this-&gt;deadlineDate);
			$diff = $dead - intval(PRJ_DTE_NOW) ;
			if ($diff &lt; 0) {
                $format = ($short)?'SHT':'SHX';
				if ($this-&gt;itemStatus-&gt;statusKey &lt; FRK_STATUS_LEVELS) {
					return '<span class="dlate">'.$this-&gt;getDte('deadlineDate',$format).'</span>';
				} else {
					return '<span class="ddone">'.$this-&gt;getDte('deadlineDate',$format).'</span>';
				}
			} else if ($diff == 0) {
				if (@constant('FRK_DATEDIFF_MODE') == 'date') {
					return '<span class="dday">'.$this-&gt;getDte('deadlineDate',($short)?'SHT':'SHX','').'</span>';
				} else {
					return '<span class="dday">'.$GLOBALS['langTznDate']['today'].'</span>';
				}
			} else if ($short) {
                $diff = $diff / 3600 / 24;
				switch (@constant('FRK_DATEDIFF_MODE')) {
				case 'day':
					if (@constant('FRK_DATEDIFF_TOMORROW') &amp;&amp; $diff == 1) {
						return $GLOBALS['langTznDate']['tomorrow'];
					} else if ($diff &lt; 7) {
					    $day = strtolower(date('l',$dead));
					    if (array_key_exists($day,$GLOBALS['langTznDate'])) {
					       $day = ucfirst($GLOBALS['langTznDate'][$day]);
					    }
					    return '<span class="small">'.ucFirst($day).'</span>';
					} else {
					    return '<span class="small">'
							.$this-&gt;getDte('deadlineDate',($short)?'SHT':'SHX','')
							.'</span>';
					}
					break;
				case 'diff':
					switch($diff) {
						case '1':
							if (@constant('FRK_DATEDIFF_TOMORROW')) {
								return $GLOBALS['langTznDate']['tomorrow'];
							} else {
								return '1 '.$GLOBALS['langTznDate']['day'];
							}
							break;
						case '2':
						case '3':
						case '4':
						case '5':
						case '6':
							return $diff.' '.$GLOBALS['langTznDate']['dasy'];
							break;
						default:
							return '<span class="small">'
								.$this-&gt;getDte('deadlineDate',($short)?'SHT':'SHX','')
								.'</span>';
							break;
					}
					break;
				default:
					return '<span class="small">'
						.$this-&gt;getDte('deadlineDate','SHT','')
						.'</span>';
					break;
				}
            } else {
                return '<span class="dtodo">'.$this-&gt;getDte('deadlineDate','SHX').'</span>'; 
            }
        }
    }

//--&gt; begin Time Clock addition
    function getTimeStats($itemId,$memberId) {
     
     	// will this query work for mysql &lt; 4.1 ?
        $sql = 'SELECT MAX(itc.itemTimeClockId) as itemClockId, MAX(itc.isClockRunning) as itemClockRunning '
	   		.'FROM '.$this-&gt;gTable('itemTimeClock').' AS itc '
			.'WHERE itc.itemId = '.$itemId.' AND itc.memberId = '.$memberId.' GROUP BY itc.itemId LIMIT 1';
		$this-&gt;getConnection();
		if ($result = $this-&gt;query($sql)) {
			if ($data = $result-&gt;rNext()) {
				$this-&gt;setNum('itemClockId',$data-&gt;itemClockId);
				$this-&gt;setNum('itemClockRunning',$data-&gt;itemClockRunning);			 	
			}   
        }
		unset($sql,$result,$data);
		
		// get total time
        $sql = 'SELECT SUM(itc.subtotalTime) as itemTotalTime '
	   		.'FROM '.$this-&gt;gTable('itemTimeClock').' AS itc '
			.'WHERE itc.itemId = '.$itemId.' GROUP BY itc.itemId LIMIT 1';
		$this-&gt;getConnection();
		if ($result = $this-&gt;query($sql)) {
			if ($data = $result-&gt;rNext()) {
				$this-&gt;setStr('itemTotalTime',$this-&gt;formatTime($data-&gt;itemTotalTime));
				$this-&gt;setStr('itemTotalTimeSec',$data-&gt;itemTotalTime);
			}   
        }
 	}
 	
//&lt;-- end Time Clock addition

    function pDeadline() {
		echo $this-&gt;getDeadline(true);
	}

    function pStatus() {
		echo $this-&gt;itemStatus-&gt;getStatus();
	}
	

    function checkRights($userId, $level=0, $userCanToo=false) {
    	if (!$this-&gt;position) {
    		$this-&gt;position = 0;
    	}
        if ($userCanToo &amp;&amp; $userId == $this-&gt;member-&gt;id) {
            return true;
        } else if ($userId == $this-&gt;authorId) {
            return true;
        } else if ($level) {
            $level--;
            return ($GLOBALS['confProjectRights'][$this-&gt;position]{$level} == '1');
        } else {
            return (intval($this-&gt;position) &gt; 0);
        }
    }

    function _cleanProperties() {
        unset($this-&gt;_properties['itemCommentCount']);
        unset($this-&gt;_properties['itemFileCount']);
        unset($this-&gt;_properties['position']);
        unset($this-&gt;_properties['itemStatus']);
//--&gt; begin Time Clock addition
		unset($this-&gt;_properties['itemTotalTime']);
		unset($this-&gt;_properties['itemTotalTimeSec']);		
		unset($this-&gt;_properties['itemClockId']);		
		unset($this-&gt;_properties['itemClockRunning']);
//&lt;-- end Time Clock addition
        unset($this-&gt;itemStatus);
        unset($this-&gt;itemCommentCount);
        unset($this-&gt;itemFileCount);
        unset($this-&gt;position);
    }

    function add() {
        $this-&gt;_cleanProperties();
        parent::add();
    }
	
    function update($param='') {
        $this-&gt;_cleanProperties();
        parent::update($param);
    }

	function load($userId) {
		if (!$this-&gt;id) {
			return false;
		}
        if (@constant('FRK_MYSQL_VERSION_GT_4_1')) {
            // optimize for mysql &gt; 4.1
            $sql = 'SELECT ii.*, count(iic.postDate) as itemCommentCount, count(iif.postDate) as itemFileCount, '
                .'iis.statusDate as itemStatus_statusDate, iis.statusDate, iis.statusKey as itemStatus_statusKey, '
                .'pp.name as project_name, '
                .'mm.title as member_title, mm.firstName as member_firstName, mm.middleName as member_middleName, '
                .'mm.lastName as member_lastName, mm.username as member_username, mp.position '
                .'FROM '.$this-&gt;gTable().' AS ii '
                .'INNER JOIN '.$this-&gt;gTable('itemStatus').' AS iis ON ii.itemId = iis.itemId '
                .'LEFT JOIN '.$this-&gt;gTable('project').' AS pp ON ii.projectId = pp.projectId '
                .'LEFT JOIN '.$this-&gt;gTable('memberProject').' AS mp ON ii.projectId = mp.projectId AND mp.memberId='.$userId
                .' LEFT JOIN '.$this-&gt;gTable('member').' AS mm ON ii.memberId = mm.memberId '
                .'LEFT JOIN '.$this-&gt;gTable('itemComment').' AS iic ON ii.itemId=iic.itemId '
                .'LEFT JOIN '.$this-&gt;gTable('itemFile').' AS iif ON ii.itemId=iif.itemId '
                .'WHERE iis.statusDate=(SELECT MAX(iis2.statusDate) FROM '.$this-&gt;gTable('itemStatus')
                .' AS iis2 WHERE ii.itemId = iis2.itemId) AND ii.itemId = '.$this-&gt;id.' GROUP BY ii.itemId';
        } else {
            $sql = 'SELECT ii.*, count(iic.postDate) as itemCommentCount, count(iif.postDate) as itemFileCount, '
                .'SUBSTRING(MAX(CONCAT(iis.statusDate,iis.statusKey)),1,19) AS itemStatus_statusDate, '
                .'SUBSTRING(MAX(CONCAT(iis.statusDate,iis.statusKey)),20) AS itemStatus_statusKey, '
                .'pp.name as project_name, '
                .'mm.title as member_title, mm.firstName as member_firstName, mm.middleName as member_middleName, '
                .'mm.lastName as member_lastName, mm.username as member_username, mp.position '
                .'FROM '.$this-&gt;gTable().' AS ii '
                .'INNER JOIN '.$this-&gt;gTable('itemStatus').' AS iis ON ii.itemId = iis.itemId '
                .'LEFT JOIN '.$this-&gt;gTable('project').' AS pp ON ii.projectId = pp.projectId '
                .'LEFT JOIN '.$this-&gt;gTable('memberProject').' AS mp ON ii.projectId = mp.projectId AND mp.memberId='.$userId
                .' LEFT JOIN '.$this-&gt;gTable('member').' AS mm ON ii.memberId = mm.memberId '
                .'LEFT JOIN '.$this-&gt;gTable('itemComment').' AS iic ON ii.itemId=iic.itemId '
                .'LEFT JOIN '.$this-&gt;gTable('itemFile').' AS iif ON ii.itemId=iif.itemId '
                .'WHERE ii.itemId = '.$this-&gt;id.' GROUP BY ii.itemId';
        }
		$this-&gt;getConnection();
		if ($result = $this-&gt;query($sql)) {
			if ($data = $result-&gt;rNext()) {
				$this-&gt;setAuto($data);
//--&gt; begin Time Clock addition
				$this-&gt;getTimeStats($this-&gt;id,$this-&gt;member-&gt;id);	
//&lt;-- end Time Clock addition
				$this-&gt;_loaded = true;
				return $this-&gt;id;
			}   
        }
		return false;
	}
	
	function addDateFilter($filter) {
		if (@constant('FRK_MYSQL_VERSION_GT_4_1')) {
			$this-&gt;addWhere('('.$filter.')');
		} else {
			$this-&gt;addHaving(str_replace('status','itemStatus_status',$filter));
		}
	}
	
	function loadList($userId=0) {
		$sql = 'SELECT ii.*, ';
        if (@constant('FRK_MYSQL_VERSION_GT_4_1')) {
			$sql .= 'count(iic.postDate) as itemCommentCount, '
				.'count(iif.postDate) as itemFileCount, '
				.'iis.statusDate as itemStatus_statusDate, iis.statusKey as itemStatus_statusKey, ';
        } else {
            $sql .= 'count(DISTINCT iic.postDate) as itemCommentCount, '
				.'count(DISTINCT iif.postDate) as itemFileCount, '
				.'SUBSTRING(MAX(CONCAT(iis.statusDate,iis.statusKey)),1,19) AS itemStatus_statusDate, '
                .'SUBSTRING(MAX(CONCAT(iis.statusDate,iis.statusKey)),20) AS itemStatus_statusKey, ';
        }
        $sql .= 'pp.name as project_name, '
            .'mm.title as member_title, mm.firstName as member_firstName, mm.middleName as member_middleName, '
            .'mm.lastName as member_lastName, mm.username as member_username';
        if ($userId) {
            $sql .= ', mp.position';
        }
        $sql .= ' FROM '.$this-&gt;gTable().' as ii '
            .'INNER JOIN '.$this-&gt;gTable('itemStatus').' AS iis ON ii.itemId = iis.itemId '
            .'LEFT JOIN '.$this-&gt;gTable('project').' AS pp ON ii.projectId = pp.projectId';
        if ($userId) {
            $sql .= ' LEFT JOIN '.$this-&gt;gTable('memberProject')
                .' AS mp ON ii.projectId = mp.projectId AND mp.memberId='.$userId;
        }
        $sql .= ' LEFT JOIN '.$this-&gt;gTable('member').' AS mm ON ii.memberId = mm.memberId '
            .'LEFT JOIN '.$this-&gt;gTable('itemComment').' AS iic ON ii.itemId=iic.itemId '
			.'LEFT JOIN '.$this-&gt;gTable('itemFile').' AS iif ON ii.itemId=iif.itemId ';
		$this-&gt;addGroup('ii.itemId');
        if (@constant('FRK_MYSQL_VERSION_GT_4_1')) {
            $this-&gt;addWhere('iis.statusDate=(SELECT MAX(iis2.statusDate) FROM '.$this-&gt;gTable('itemStatus')
                .' AS iis2 WHERE ii.itemId = iis2.itemId)');
        }
		return parent::loadList($sql);
	}
}

class ItemContextList extends TznCollection
{
    function ItemContextList() {
		parent::TznCollection($GLOBALS['langItemContext']);
    }

    function getColor($code) {
        if (array_key_exists($code, $GLOBALS['confContext'])) {
            return $GLOBALS['confContext'][$code];
        } else {
            return '#666';
        }
    }

}

class ItemComment extends TznDb
{
	function ItemComment()
	{
		parent::TznDb('itemComment');
		$this-&gt;addProperties(array(
			'id'				=&gt; 'UID',
			'itemId'			=&gt; 'NUM',
			'member'			=&gt; 'OBJ',
			'postDate'			=&gt; 'DTM',
			'body'				=&gt; 'BBS',
			'lastChangeDate'	=&gt; 'DTM'
		));
	}
	
	/*
	function _idkey() {
		return 'taskId = '.$this-&gt;taskId
			.' AND memberId = '.$this-&gt;member-&gt;id
			.' AND postDate = \''.$this-&gt;postDate.'\'';
	}
	 */

	function checkRights($userId, $level=0, $objTask, $userCanToo=false) {
		//error_log('checkin #'.$this-&gt;id.'/'.$level.' : '.$userId.' = '.$this-&gt;member-&gt;id);
		if ($userId == $objTask-&gt;member-&gt;id &amp;&amp; $userCanToo) {
			return true;
		} else if ($userId == $this-&gt;member-&gt;id) {
            return true;
        } else if ($level) {
            $level--;
            return ($GLOBALS['confProjectRights'][$objTask-&gt;position]{$level} == '1');
		} else {
			return false;
		}
    }
	
	function add() {
		$this-&gt;setDtm('postDate','NOW');
		return parent::add();
	}
	
	function update() {
		$this-&gt;setDtm('lastChangeDate','NOW');
		return parent::update();
	}
	
	/*
	function delete() {
		if ($this-&gt;taskId &amp;&amp; $this-&gt;member-&gt;id &amp;&amp; $this-&gt;postDate) {
			$this-&gt;getConnection();
			$sql = 'DELETE FROM taskComment WHERE '.$this-&gt;_idkey();
			return $this-&gt;query($sql);
		} else {
			return false;
		}
	}
	*/
	
}

class ItemCommentFull extends ItemComment
{

	function ItemCommentFull()
	{
		parent::TaskComment();
		$this-&gt;addProperties(array(
			'memberProject'			=&gt; 'OBJ'
		));
	}
	
	function loadList() {
		$sql = 'SELECT iic.*, mm.username as member_username, mm.timeZone as member_timeZone,'
			.'mm.creationDate as member_creationDate, mm.firstName as member_firstName, '
			.'mm.middleName as member_middleName, mm.lastName as member_lastName, '
			.'mp.position as memberTeam_position '
			.'FROM '.$this-&gt;gTable('itemComment').' AS iic '
            .'INNER JOIN '.$this-&gt;gTable('member').' AS mm ON iic.memberId=mm.memberId '
			.'INNER JOIN '.$this-&gt;gTable('item').' AS ii ON ii.itemId = iic.itemId '
			.'LEFT JOIN '.$this-&gt;gTable('memberProject').' AS mp ON iic.memberId = mp.memberId '
			.'AND mp.teamId = ii.teamId';
		return parent::loadList($sql);
	}

}

// easy meat

class ItemPriority extends TznCollection
{
	
	function ItemPriority() {
		$prioCount = (@constant('FRK_PRIORITY_LEVELS'))?FRK_PRIORITY_LEVELS:9;
		$arrPrio = array();
		for($i=1;$i&lt;=$prioCount;$i++) {
			$arrPrio[$i] = $i;
		}
		parent::TznCollection($arrPrio);
	}
}

//--&gt; begin Time Clock addition
class ItemTimeClock extends TznDb
{
	function ItemTimeClock()
	{
		parent::TznDb('itemTimeClock');
		$this-&gt;addProperties(array(
			'id'				=&gt; 'UID',
			'itemId'			=&gt; 'NUM',
			'startTime'			=&gt; 'DTM',
			'stopTime'			=&gt; 'DTM',
			'subtotalTime'		=&gt; 'NUM',
			'isClockRunning'	=&gt; 'NUM',
			'member'			=&gt; 'OBJ'
		));
	}
	
	function checkRights($userId, $level=0, $objTask) {
		error_log('checkin #'.$this-&gt;id.'/'.$level.' : '.$userId.' = '.$this-&gt;member-&gt;id);
        if ($userId == $this-&gt;member-&gt;id) {
            return true;
        } else if ($level) {
            $level--;
            return ($GLOBALS['confProjectRights'][$objTask-&gt;position]{$level} == '1');
		} else {
			return false;
		}
    }
    
    // begins new logged time in db
	function add() {
		$this-&gt;setDtm('startTime','NOW');
		$this-&gt;setNum('isClockRunning','1');
		return parent::add();
	}

	// inserts changed time to db
	function addChange($subtotalTime) {
		$this-&gt;setDtm('startTime','NOW');
		$this-&gt;setDtm('stopTime','NOW');
		$this-&gt;setNum('subtotalTime',$subtotalTime,1);
		$this-&gt;setNum('isClockRunning','0');
		return parent::add();
	}
	
	// stops time in db
	function update() {
		$this-&gt;setDtm('stopTime','NOW');
		$this-&gt;setNum('isClockRunning','0');

		// get values from db
		$startTime = strtotime(Tzn::_value('startTime'));
		$stopTime = strtotime(Tzn::_value('stopTime'));
	
		if ($stopTime &gt; $startTime) {
			$subtotalTime = $stopTime - $startTime;
			$this-&gt;setNum('subtotalTime',$subtotalTime);
		}

		return parent::update();
	}
	
}
//&lt;-- end Time Clock addition

class ItemFile extends TznDb
{
	function ItemFile()
	{
		parent::TznDb('itemFile');
		$this-&gt;addProperties(array(
			'id'					=&gt; 'UID',
			'itemId'			=&gt; 'NUM',
			'member'			=&gt; 'OBJ',
			'filename'		=&gt; 'STR',
			'filedesc'		=&gt; 'BBS',
			'filesize'		=&gt; 'NUM',
			'postDate'		=&gt; 'DTM',
		));
	}

	function convFileSize() {
		$calc = $this-&gt;filesize / 1024;
		$calc = number_format($calc, 0, '', ' ');
		$this-&gt;filesize = $calc;
	}
	
	function convFileTime() {
		$time = $this-&gt;getDtm('postDate','SHT',$objUser-&gt;timeZone);
		$this-&gt;postDate = $time;
	}

	function deleteFile() {
	 	$table = &quot;itemFile&quot;;
		if (parent::delete(&quot;&quot;,$table)) {
			$this-&gt;query('DELETE FROM '.$this-&gt;gTable($table).' WHERE itemFileId='.$this-&gt;id);
			@unlink(FRK_ATTACHMENT_FOLDER.$this-&gt;id.&quot;.frk&quot;);
			return true;
		}
		return false;
	}

	function uploadFile() {
		$this-&gt;setDtm('postDate','NOW');
		return parent::add();
	}
	
	function checkRights($userId, $level=0, $objTask) {
		error_log('checkin #'.$this-&gt;id.'/'.$level.' : '.$userId.' = '.$this-&gt;member-&gt;id);
        if ($userId == $this-&gt;member-&gt;id) {
            return true;
        } else if ($level) {
            $level--;
            return ($GLOBALS['confProjectRights'][$objTask-&gt;position]{$level} == '1');
		} else {
			return false;
		}
  }

}
?&gt;
