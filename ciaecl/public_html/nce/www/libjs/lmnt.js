/*

  This code is part of LDAP Account Manager (http://www.sourceforge.net/projects/lam)
  Copyright (C) 2004 Roland Gruber

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

	Ported to javascript by Juan Carlos Maureira
	Center for Mathematical Modelling
	Univ. de Chile

*/

// Contants used in lanlam hash calculations
// Ported from SAMBA/source/libsmb/smbdes.c:perm1[56]
var $perm1 = [ 57, 49, 41, 33, 25, 17,  9,
        1, 58, 50, 42, 34, 26, 18,
        10,  2, 59, 51, 43, 35, 27,
        19, 11,  3, 60, 52, 44, 36,
        63, 55, 47, 39, 31, 23, 15,
        7, 62, 54, 46, 38, 30, 22,
        14,  6, 61, 53, 45, 37, 29,
        21, 13,  5, 28, 20, 12,  4 ];
// Ported from SAMBA/source/libsmb/smbdes.c:perm2[48]
var $perm2 = [ 14, 17, 11, 24,  1,  5,
        3, 28, 15,  6, 21, 10,
        23, 19, 12,  4, 26,  8,
        16,  7, 27, 20, 13,  2,
        41, 52, 31, 37, 47, 55,
        30, 40, 51, 45, 33, 48,
        44, 49, 39, 56, 34, 53,
        46, 42, 50, 36, 29, 32 ];

// Ported from SAMBA/source/libsmb/smbdes.c:perm3[64]
var $perm3 = [ 58, 50, 42, 34, 26, 18, 10,  2,
        60, 52, 44, 36, 28, 20, 12,  4,
        62, 54, 46, 38, 30, 22, 14,  6,
        64, 56, 48, 40, 32, 24, 16,  8,
        57, 49, 41, 33, 25, 17,  9,  1,
        59, 51, 43, 35, 27, 19, 11,  3,
        61, 53, 45, 37, 29, 21, 13,  5,
        63, 55, 47, 39, 31, 23, 15,  7 ];
// Ported from SAMBA/source/libsmb/smbdes.c:perm4[48]
var $perm4 = [ 32,  1,  2,  3,  4,  5,
        4,  5,  6,  7,  8,  9,
        8,  9, 10, 11, 12, 13,
        12, 13, 14, 15, 16, 17,
        16, 17, 18, 19, 20, 21,
        20, 21, 22, 23, 24, 25,
        24, 25, 26, 27, 28, 29,
        28, 29, 30, 31, 32,  1 ];
// Ported from SAMBA/source/libsmb/smbdes.c:perm5[32]
var $perm5 = [ 16,  7, 20, 21,
        29, 12, 28, 17,
        1, 15, 23, 26,
        5, 18, 31, 10,
        2,  8, 24, 14,
        32, 27,  3,  9,
        19, 13, 30,  6,
        22, 11,  4, 25 ];
// Ported from SAMBA/source/libsmb/smbdes.c:perm6[64]
var $perm6 = [ 40,  8, 48, 16, 56, 24, 64, 32,
        39,  7, 47, 15, 55, 23, 63, 31,
        38,  6, 46, 14, 54, 22, 62, 30,
        37,  5, 45, 13, 53, 21, 61, 29,
        36,  4, 44, 12, 52, 20, 60, 28,
        35,  3, 43, 11, 51, 19, 59, 27,
        34,  2, 42, 10, 50, 18, 58, 26,
        33,  1, 41,  9, 49, 17, 57, 25 ];
// Ported from SAMBA/source/libsmb/smbdes.c:sc[16]
var $sc = [ 1, 1, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 1 ];
// Ported from SAMBA/source/libsmb/smbdes.c:sbox[8][4][16]
// Side note, I used cut and paste for all these numbers, I did NOT
// type them all in =)
var $sbox = [ [ [ 14,  4, 13,  1,  2, 15, 11,  8,  3, 10,  6, 12,  5,  9,  0,  7 ],
                [ 0, 15,  7,  4, 14,  2, 13,  1, 10,  6, 12, 11,  9,  5,  3,  8 ],
                [ 4,  1, 14,  8, 13,  6,  2, 11, 15, 12,  9,  7,  3, 10,  5,  0 ],
                [ 15, 12,  8,  2,  4,  9,  1,  7,  5, 11,  3, 14, 10,  0,  6, 13 ]],
        [ [ 15,  1,  8, 14,  6, 11,  3,  4,  9,  7,  2, 13, 12,  0,  5, 10 ],
                [ 3, 13,  4,  7, 15,  2,  8, 14, 12,  0,  1, 10,  6,  9, 11,  5 ],
                [ 0, 14,  7, 11, 10,  4, 13,  1,  5,  8, 12,  6,  9,  3,  2, 15 ],
                [ 13,  8, 10,  1,  3, 15,  4,  2, 11,  6,  7, 12,  0,  5, 14,  9 ]],
        [ [ 10,  0,  9, 14,  6,  3, 15,  5,  1, 13, 12,  7, 11,  4,  2,  8],
                [ 13,  7,  0,  9,  3,  4,  6, 10,  2,  8,  5, 14, 12, 11, 15,  1],
                [ 13,  6,  4,  9,  8, 15,  3,  0, 11,  1,  2, 12,  5, 10, 14,  7],
                [ 1, 10, 13,  0,  6,  9,  8,  7,  4, 15, 14,  3, 11,  5,  2, 12]],
        [ [ 7, 13, 14,  3,  0,  6,  9, 10,  1,  2,  8,  5, 11, 12,  4, 15],
                [ 13,  8, 11,  5,  6, 15,  0,  3,  4,  7,  2, 12,  1, 10, 14,  9],
                [ 10,  6,  9,  0, 12, 11,  7, 13, 15,  1,  3, 14,  5,  2,  8,  4],
                [ 3, 15,  0,  6, 10,  1, 13,  8,  9,  4,  5, 11, 12,  7,  2, 14]],
        [ [ 2, 12,  4,  1,  7, 10, 11,  6,  8,  5,  3, 15, 13,  0, 14,  9],
                [ 14, 11,  2, 12,  4,  7, 13,  1,  5,  0, 15, 10,  3,  9,  8,  6],
                [ 4,  2,  1, 11, 10, 13,  7,  8, 15,  9, 12,  5,  6,  3,  0, 14],
                [ 11,  8, 12,  7,  1, 14,  2, 13,  6, 15,  0,  9, 10,  4,  5,  3]],
        [ [ 12,  1, 10, 15,  9,  2,  6,  8,  0, 13,  3,  4, 14,  7,  5, 11],
                [ 10, 15,  4,  2,  7, 12,  9,  5,  6,  1, 13, 14,  0, 11,  3,  8],
                [  9, 14, 15,  5,  2,  8, 12,  3,  7,  0,  4, 10,  1, 13, 11,  6],
                [  4,  3,  2, 12,  9,  5, 15, 10, 11, 14,  1,  7,  6,  0,  8, 13]],
        [ [ 4, 11,  2, 14, 15,  0,  8, 13,  3, 12,  9,  7,  5, 10,  6,  1],
                [ 13,  0, 11,  7,  4,  9,  1, 10, 14,  3,  5, 12,  2, 15,  8,  6],
                [  1,  4, 11, 13, 12,  3,  7, 14, 10, 15,  6,  8,  0,  5,  9,  2],
                [  6, 11, 13,  8,  1,  4, 10,  7,  9,  5,  0, 15, 14,  2,  3, 12]],
        [ [ 13,  2,  8,  4,  6, 15, 11,  1, 10,  9,  3, 14,  5,  0, 12,  7],
                [ 1, 15, 13,  8, 10,  3,  7,  4, 12,  5,  6, 11,  0, 14,  9,  2],
                [ 7, 11,  4,  1,  9, 12, 14,  2,  0,  6, 10, 13, 15,  3,  5,  8],
                [ 2,  1, 14,  7,  4, 10,  8, 13, 15, 12,  9,  0,  3,  5,  6, 11 ]]];

/**
* Fixes too large numbers
*/
function x($i) {
	if ($i < 0) return 4294967296 - $i;
	else return $i;
}

function strtoupper($str) {
	var s = new String($str)
	return(s.toUpperCase());
}

function substr($str,$i,$t) {
	var s = new String($str)
	return(s.substring($i,$t));
}

function sizeof($a) {
	return($a.length);
}

function str_pad (input, pad_length, pad_string, pad_type)
{
  input = String (input);
  pad_string = pad_string != null ? pad_string : " ";
  if (pad_string.length > 0)
  {
    var padi = 0;
    pad_type = pad_type != null ? pad_type : "STR_PAD_RIGHT";
    pad_length = parseInt (pad_length);
    switch (pad_type)
    {
      case "STR_PAD_BOTH":
        input = str_pad (input
                       , input.length + Math.ceil ((pad_length - input.length) / 2.0)
                       , pad_string, "STR_PAD_RIGHT");
     // break;  // kein break!
      case "STR_PAD_LEFT":
        var buffer = "";
        for (var i = 0, z = pad_length - input.length; i < z; ++i)
        {
          buffer += pad_string.charAt(padi); // [padi] IE 6.x bug
          if (++padi == pad_string.length)
            padi = 0;
        }
        input = buffer + input;
        break;
      default:
        for (var i = 0, z = pad_length - input.length; i < z; ++i)
        {
          input += pad_string.charAt(padi);
          if (++padi == pad_string.length)
            padi = 0;
        }
        break;
    }
  }
  return input;
}

function chr(number) {
	return(String.fromCharCode(number));
}

function isset(varname)  {
	if (typeof varname == "undefined")
		return false
  else return true;
}


function unpack($type,$str) {
	$a = new Array();
	$s = new String($str); 
	for($i=0;$i<$s.length;$i++) {
		$a.push($s.charCodeAt($i));
	}
	return($a);
}

function sprintf() {
    function pad(str, len, chr, leftJustify) {
	var padding = (str.length >= len) ? '' : Array(1 + len - str.length >>> 0).join(chr);
	return leftJustify ? str + padding : padding + str;

    }

    function justify(value, prefix, leftJustify, minWidth, zeroPad) {
	var diff = minWidth - value.length;
	if (diff > 0) {
	    if (leftJustify || !zeroPad) {
		value = pad(value, minWidth, ' ', leftJustify);
	    } else {
		value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
	    }
	}
	return value;
    }

    function formatBaseX(value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
	// Note: casts negative numbers to positive ones
	var number = value >>> 0;
	prefix = prefix && number && {'2': '0b', '8': '0', '16': '0x'}[base] || '';
	value = prefix + pad(number.toString(base), precision || 0, '0', false);
	return justify(value, prefix, leftJustify, minWidth, zeroPad);
    }

    function formatString(value, leftJustify, minWidth, precision, zeroPad) {
	if (precision != null) {
	    value = value.slice(0, precision);
	}
	return justify(value, '', leftJustify, minWidth, zeroPad);
    }

    var a = arguments, i = 0, format = a[i++];
    return format.replace(sprintf.regex, function(substring, valueIndex, flags, minWidth, _, precision, type) {
	    if (substring == '%%') return '%';

	    // parse flags
	    var leftJustify = false, positivePrefix = '', zeroPad = false, prefixBaseX = false;
	    for (var j = 0; flags && j < flags.length; j++) switch (flags.charAt(j)) {
		case ' ': positivePrefix = ' '; break;
		case '+': positivePrefix = '+'; break;
		case '-': leftJustify = true; break;
		case '0': zeroPad = true; break;
		case '#': prefixBaseX = true; break;
	    }

	    // parameters may be null, undefined, empty-string or real valued
	    // we want to ignore null, undefined and empty-string values

	    if (!minWidth) {
		minWidth = 0;
	    } else if (minWidth == '*') {
		minWidth = +a[i++];
	    } else if (minWidth.charAt(0) == '*') {
		minWidth = +a[minWidth.slice(1, -1)];
	    } else {
		minWidth = +minWidth;
	    }

	    // Note: undocumented perl feature:
	    if (minWidth < 0) {
		minWidth = -minWidth;
		leftJustify = true;
	    }

	    if (!isFinite(minWidth)) {
		throw new Error('sprintf: (minimum-)width must be finite');
	    }

	    if (!precision) {
		precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type == 'd') ? 0 : void(0);
	    } else if (precision == '*') {
		precision = +a[i++];
	    } else if (precision.charAt(0) == '*') {
		precision = +a[precision.slice(1, -1)];
	    } else {
		precision = +precision;
	    }

	    // grab value using valueIndex if required?
	    var value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

	    switch (type) {
		case 's': return formatString(String(value), leftJustify, minWidth, precision, zeroPad);
		case 'c': return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
		case 'b': return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
		case 'o': return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
		case 'x': return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
		case 'X': return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
		case 'u': return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
		case 'i':
		case 'd': {
			      var number = parseInt(+value);
			      var prefix = number < 0 ? '-' : positivePrefix;
			      value = prefix + pad(String(Math.abs(number)), precision, '0', false);
			      return justify(value, prefix, leftJustify, minWidth, zeroPad);
			  }
		case 'e':
		case 'E':
		case 'f':
		case 'F':
		case 'g':
		case 'G':
		          {
			      var number = +value;
			      var prefix = number < 0 ? '-' : positivePrefix;
			      var method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
			      var textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
			      value = prefix + Math.abs(number)[method](precision);
			      return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
			  }
		default: return substring;
	    }
		    });
}
sprintf.regex = /%%|%(\d+\$)?([-+#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuidfegEG])/g;

/**
 * Trival printf implementation, probably only useful during page-load.
 * Note: you may as well use "document.write(sprintf(....))" directly
 */
function printf() {
    // delegate the work to sprintf in an IE5 friendly manner:
    var i = 0, a = arguments, args = Array(arguments.length);
    while (i < args.length) args[i] = 'a[' + (i++) + ']';
    document.write(eval('sprintf(' + args + ')'));
}

function strlen($str) {
	return($str.length);
}

/**
* @param integer count
* @param array $data
* @return array
*/
function lshift($count, $data) {
	var $ret = [];
	for ($j1 = 0; $j1 < sizeof($data); $j1++) {
		$ret[$j1] = $data[($j1 + $count) % sizeof($data)];
	}
	return $ret;
}

/**
* @param array in input data
* @param array p permutation
* @return array
*/
function permute($in, $p, $n) {
	var $ret = new Array();
	for ($o = 0; $o < $n; $o++) {
		if ($in[$p[$o]-1]) {
			$ret[$o] = 1;
		} else {
			$ret[$o] = 0;
		}
	}
	return $ret;
}

/**
* @param array $in1
* @param array $in2
* @return array
*/
function mxor($inp1, $inp2) {
	var $ret = new Array();
	for ($i2 = 0; $i2 < sizeof($inp1); $i2++) {
		$ret[$i2] = $inp1[$i2] ^ $inp2[$i2];
	}
	return $ret;
}

/**
* @param array $in
* @param array $key
* @param boolean $forw
* @return array
*/

function doHash($in, $key, $forw) {
	var $ki = [];

	var $pk1 = permute($key, $perm1, 56);
	
	var $c = [];
	var $d = [];

	for ($i = 0; $i < 28; $i++) {
		$c[$i] = $pk1[$i];
		$d[$i] = $pk1[28 + $i];
	}
	
	for ($i = 0; $i < 16; $i++) {
		$c = lshift($sc[$i], $c);
		$d = lshift($sc[$i], $d);

		$cd = [];
		for ($k = 0; $k < sizeof($c); $k++) {
			 $cd.push($c[$k]);
		}

		for ($k = 0; $k < sizeof($d); $k++) {
			 $cd.push($d[$k]);
		}

		$ki[$i] = permute($cd, $perm2, 48);
	}
	
	$pd1 = permute($in, $perm3, 64);
	
	$l = new Array();
	$r = new Array();

	for ($i = 0; $i < 32; $i++) {
		$l[$i] = $pd1[$i];
		$r[$i] = $pd1[32 + $i];
	}

	for ($i = 0; $i < 16; $i++) {

		$er = permute($r, $perm4, 48);

		if ($forw) {
			$erk = mxor($er, $ki[$i]);
		} else {
			$erk = mxor($er, $ki[15 - $i]);
		}


		$b = [];
	
		for ($j = 0; $j < 8; $j++) {
			$b[$j] = [];

			for ($k = 0; $k < 6; $k++) {
				var $idx = ($j * 6) + $k;

				$b[$j][$k] = $erk[$idx];

			}

		}

		for ($j = 0; $j < 8; $j++) {

			var $m = [];
			var n$ = [];

			var $m = ($b[$j][0] << 1) | $b[$j][5];
			var $n = ($b[$j][1] << 3) | ($b[$j][2] << 2) | ($b[$j][3] << 1) | $b[$j][4];
			
			for ($k = 0; $k < 4; $k++) {
				var t2 = $sbox[$j][$m][$n] & (1 << (3-$k));
				if (t2) {
					$b[$j][$k] = 1;
				} else {
					$b[$j][$k] = 0;
				}

			}
		}

		$cb = new Array();
		
		for ($j = 0; $j < 8; $j++) {
			for ($k = 0; $k < 4; $k++) {
				var idx = ($j * 4) + $k;
				$cb[idx] = $b[$j][$k];
			}
		}

		$pcb = permute($cb, $perm5, 32);

		$r2 = mxor($l, $pcb);

		for ($k = 0; $k < 32; $k++) {
			$l[$k] = $r[$k];
		}
		for ($k = 0; $k < 32; $k++) {
			$r[$k] = $r2[$k];
		}
	}

	var $rl = $r;
	for ($i = 0; $i < sizeof($l); $i++) {
		$rl.push($l[$i]);
	}

	$ret = permute($rl, $perm6, 64);

	return $ret;
}

function str_to_key($str) {
	$key = new Array();
	$key[0] = unsigned_shift_r($str[0], 1);
	$key[1] = (($str[0]&0x01)<<6) | unsigned_shift_r($str[1], 2);
	$key[2] = (($str[1]&0x03)<<5) | unsigned_shift_r($str[2], 3);
	$key[3] = (($str[2]&0x07)<<4) | unsigned_shift_r($str[3], 4);
	$key[4] = (($str[3]&0x0F)<<3) | unsigned_shift_r($str[4], 5);
	$key[5] = (($str[4]&0x1F)<<2) | unsigned_shift_r($str[5], 6);
	$key[6] = (($str[5]&0x3F)<<1) | unsigned_shift_r($str[6], 7);
	$key[7] = $str[6]&0x7F;
	for ($i = 0; $i < 8; $i++) {
		$key[$i] = ($key[$i] << 1);
	}
	return $key;
}

function smb_hash($in, $key, $forw){
	$key2 = str_to_key($key);

	$inb = new Array();
	$keyb = new Array();
	$outb = new Array();
	
	for ($i = 0; $i < 64; $i++) {

		var idx = parseInt($i/8);

		var t0 = $in[idx] & (1<<(7-($i%8)));

		if (t0) {
			$inb[$i] = 1;
		} else {
			$inb[$i] = 0;
		}

		var t1 = $key2[idx] & (1<<(7-($i % 8)));

		if (t1) {
			$keyb[$i] = 1;
		} else {
			$keyb[$i] = 0;
		}
		$outb[$i] = 0;
	}

	$outb = doHash($inb, $keyb, $forw);

	$out = new Array();

	for ($i = 0; $i < 8; $i++) {
		$out[$i] = 0;
	}

	for ($i = 0; $i < 65; $i++) {
		if ( $outb[$i] )  {
			var idx = parseInt($i/8);
			$out[idx] |= (1<<(7-($i%8)));
		}
	}
	return $out;
}

function E_P16($in) {
	$p14 = unpack("C*",$in);
	$sp8 = new Array(0x4b, 0x47, 0x53, 0x21, 0x40, 0x23, 0x24, 0x25);
	$p14_1 = new Array();
	$p14_2 = new Array();

	for ($i = 0; $i < 7; $i++) {
		$p14_1[$i] = $p14[$i];
		$p14_2[$i] = $p14[$i + 7];
	}

	$p16_1 = smb_hash($sp8, $p14_1, 1);
	$p16_2 = smb_hash($sp8, $p14_2, 1);

	$p16 = $p16_1;
	for ($i = 0; $i < sizeof($p16_2); $i++) {
		$p16.push($p16_2[$i]);
	}
	return $p16;
}

/**
* Calculates the LM hash of a given password.
*
* @param string $password password
* @return string hash value
*/
function lmhash($password) {
	$password = strtoupper($password);
	$password = substr($password,0,14);
	$password = str_pad($password, 14, chr(0));
	$p16 = E_P16($password);
	for ($i = 0; $i < sizeof($p16); $i++) {
		$p16[$i] = sprintf("%02X", $p16[$i]);
	}
	return $p16.join("");
}

/**
* Calculates the NT hash of a given password.
*
* @param string $password password
* @return string hash value
*/
function nthash($password) {
	$password = substr($password,0,128);
	$password2 = "";
	for ($i = 0; $i < strlen($password); $i++) $password2 = $password2 + $password[$i] + chr(0);
	$password = $password2;
	$hex = hex_md4($password);
  return strtoupper($hex);
}

//Needed? because perl seems to choke on overflowing when doing bitwise
//operations on numbers larger than 32 bits. Well, it did on my machine =)
function add32($v) {
	$sum = new Array();
	for ($i5 = 0; $i5 < sizeof($v); $i5++) {
		$v[$i5] = new Array(unsigned_shift_r(($v[$i5]&0xffff0000), 16), ($v[$i]&0xffff));
	}
	for ($i5 = 0; $i5 < sizeof($v); $i5++) {
		$sum[0] += $v[$i5][0];
		$sum[1] += $v[$i5][1];
	}
	$sum[0] += ($sum[1]&0xffff0000)>>16;
	$sum[1] &= 0xffff;
	$sum[0] &= 0xffff;
	$ret = ($sum[0]<<16) | $sum[1];
	if (x($ret) > 4294967296) {
		$ret = (2*4294967296) - x($ret);
	}
	return $ret;
}

/**
* Unsigned shift operation for 32bit values.
*
*/

function unsigned_shift_r($a, $b) { 
	$z = 0x80000000; 
	if ($z & $a) { 
		$a = ($a >> 1); 
		$a &= (!$z); 
		$a |= 0x40000000; 
		$a = ($a >> ($b - 1)); 
	} 
	else { 
		$a = ($a >> $b); 
	} 
	return $a; 
}
 
/*
 * A JavaScript implementation of the RSA Data Security, Inc. MD4 Message
 * Digest Algorithm, as defined in RFC 1320.
 * Version 2.1 Copyright (C) Jerrad Pierce, Paul Johnston 1999 - 2002.
 * Other contributors: Greg Holt, Andrew Kepert, Ydnar, Lostinet
 * Distributed under the BSD License
 * See http://pajhome.org.uk/crypt/md5 for more info.
 */

/*
 * Configurable variables. You may need to tweak these to be compatible with
 * the server-side, but the defaults work in most cases.
 */
var hexcase = 0;  /* hex output format. 0 - lowercase; 1 - uppercase        */
var b64pad  = ""; /* base-64 pad character. "=" for strict RFC compliance   */
var chrsz   = 8;  /* bits per input character. 8 - ASCII; 16 - Unicode      */

/*
 * These are the functions you'll usually want to call
 */
function hex_md4(s){ return binl2hex(core_md4(str2binl(s), s.length * chrsz));}
function b64_md4(s){ return binl2b64(core_md4(str2binl(s), s.length * chrsz));}
function str_md4(s){ return binl2str(core_md4(str2binl(s), s.length * chrsz));}
function hex_hmac_md4(key, data) { return binl2hex(core_hmac_md4(key, data)); }
function b64_hmac_md4(key, data) { return binl2b64(core_hmac_md4(key, data)); }
function str_hmac_md4(key, data) { return binl2str(core_hmac_md4(key, data)); }

/* 
 * Perform a simple self-test to see if the VM is working 
 */
function md4_vm_test()
{
  return hex_md4("abc") == "a448017aaf21d8525fc10ae87aa6729d";
}

/*
 * Calculate the MD4 of an array of little-endian words, and a bit length
 */
function core_md4(x, len)
{
  /* append padding */
  x[len >> 5] |= 0x80 << (len % 32);
  x[(((len + 64) >>> 9) << 4) + 14] = len;
  
  var a =  1732584193;
  var b = -271733879;
  var c = -1732584194;
  var d =  271733878;

  for(var i = 0; i < x.length; i += 16)
  {
    var olda = a;
    var oldb = b;
    var oldc = c;
    var oldd = d;

    a = md4_ff(a, b, c, d, x[i+ 0], 3 );
    d = md4_ff(d, a, b, c, x[i+ 1], 7 );
    c = md4_ff(c, d, a, b, x[i+ 2], 11);
    b = md4_ff(b, c, d, a, x[i+ 3], 19);
    a = md4_ff(a, b, c, d, x[i+ 4], 3 );
    d = md4_ff(d, a, b, c, x[i+ 5], 7 );
    c = md4_ff(c, d, a, b, x[i+ 6], 11);
    b = md4_ff(b, c, d, a, x[i+ 7], 19);
    a = md4_ff(a, b, c, d, x[i+ 8], 3 );
    d = md4_ff(d, a, b, c, x[i+ 9], 7 );
    c = md4_ff(c, d, a, b, x[i+10], 11);
    b = md4_ff(b, c, d, a, x[i+11], 19);
    a = md4_ff(a, b, c, d, x[i+12], 3 );
    d = md4_ff(d, a, b, c, x[i+13], 7 );
    c = md4_ff(c, d, a, b, x[i+14], 11);
    b = md4_ff(b, c, d, a, x[i+15], 19);

    a = md4_gg(a, b, c, d, x[i+ 0], 3 );
    d = md4_gg(d, a, b, c, x[i+ 4], 5 );
    c = md4_gg(c, d, a, b, x[i+ 8], 9 );
    b = md4_gg(b, c, d, a, x[i+12], 13);
    a = md4_gg(a, b, c, d, x[i+ 1], 3 );
    d = md4_gg(d, a, b, c, x[i+ 5], 5 );
    c = md4_gg(c, d, a, b, x[i+ 9], 9 );
    b = md4_gg(b, c, d, a, x[i+13], 13);
    a = md4_gg(a, b, c, d, x[i+ 2], 3 );
    d = md4_gg(d, a, b, c, x[i+ 6], 5 );
    c = md4_gg(c, d, a, b, x[i+10], 9 );
    b = md4_gg(b, c, d, a, x[i+14], 13);
    a = md4_gg(a, b, c, d, x[i+ 3], 3 );
    d = md4_gg(d, a, b, c, x[i+ 7], 5 );
    c = md4_gg(c, d, a, b, x[i+11], 9 );
    b = md4_gg(b, c, d, a, x[i+15], 13);

    a = md4_hh(a, b, c, d, x[i+ 0], 3 );
    d = md4_hh(d, a, b, c, x[i+ 8], 9 );
    c = md4_hh(c, d, a, b, x[i+ 4], 11);
    b = md4_hh(b, c, d, a, x[i+12], 15);
    a = md4_hh(a, b, c, d, x[i+ 2], 3 );
    d = md4_hh(d, a, b, c, x[i+10], 9 );
    c = md4_hh(c, d, a, b, x[i+ 6], 11);
    b = md4_hh(b, c, d, a, x[i+14], 15);
    a = md4_hh(a, b, c, d, x[i+ 1], 3 );
    d = md4_hh(d, a, b, c, x[i+ 9], 9 );
    c = md4_hh(c, d, a, b, x[i+ 5], 11);
    b = md4_hh(b, c, d, a, x[i+13], 15);
    a = md4_hh(a, b, c, d, x[i+ 3], 3 );
    d = md4_hh(d, a, b, c, x[i+11], 9 );
    c = md4_hh(c, d, a, b, x[i+ 7], 11);
    b = md4_hh(b, c, d, a, x[i+15], 15);

    a = safe_add(a, olda);
    b = safe_add(b, oldb);
    c = safe_add(c, oldc);
    d = safe_add(d, oldd);

  }
  return Array(a, b, c, d);

}

/*
 * These functions implement the basic operation for each round of the
 * algorithm.
 */
function md4_cmn(q, a, b, x, s, t)
{
  return safe_add(rol(safe_add(safe_add(a, q), safe_add(x, t)), s), b);
}
function md4_ff(a, b, c, d, x, s)
{
  return md4_cmn((b & c) | ((~b) & d), a, 0, x, s, 0);
}
function md4_gg(a, b, c, d, x, s)
{
  return md4_cmn((b & c) | (b & d) | (c & d), a, 0, x, s, 1518500249);
}
function md4_hh(a, b, c, d, x, s)
{
  return md4_cmn(b ^ c ^ d, a, 0, x, s, 1859775393);
}

/*
 * Calculate the HMAC-MD4, of a key and some data
 */
function core_hmac_md4(key, data)
{
  var bkey = str2binl(key);
  if(bkey.length > 16) bkey = core_md4(bkey, key.length * chrsz);

  var ipad = Array(16), opad = Array(16);
  for(var i = 0; i < 16; i++) 
  {
    ipad[i] = bkey[i] ^ 0x36363636;
    opad[i] = bkey[i] ^ 0x5C5C5C5C;
  }

  var hash = core_md4(ipad.concat(str2binl(data)), 512 + data.length * chrsz);
  return core_md4(opad.concat(hash), 512 + 128);
}

/*
 * Add integers, wrapping at 2^32. This uses 16-bit operations internally
 * to work around bugs in some JS interpreters.
 */
function safe_add(x, y)
{
  var lsw = (x & 0xFFFF) + (y & 0xFFFF);
  var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
  return (msw << 16) | (lsw & 0xFFFF);
}

/*
 * Bitwise rotate a 32-bit number to the left.
 */
function rol(num, cnt)
{
  return (num << cnt) | (num >>> (32 - cnt));
}

/*
 * Convert a string to an array of little-endian words
 * If chrsz is ASCII, characters >255 have their hi-byte silently ignored.
 */
function str2binl(str)
{
  var bin = Array();
  var mask = (1 << chrsz) - 1;
  for(var i = 0; i < str.length * chrsz; i += chrsz)
    bin[i>>5] |= (str.charCodeAt(i / chrsz) & mask) << (i%32);
  return bin;
}

/*
 * Convert an array of little-endian words to a string
 */
function binl2str(bin)
{
  var str = "";
  var mask = (1 << chrsz) - 1;
  for(var i = 0; i < bin.length * 32; i += chrsz)
    str += String.fromCharCode((bin[i>>5] >>> (i % 32)) & mask);
  return str;
}

/*
 * Convert an array of little-endian words to a hex string.
 */
function binl2hex(binarray)
{
  var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
  var str = "";
  for(var i = 0; i < binarray.length * 4; i++)
  {
    str += hex_tab.charAt((binarray[i>>2] >> ((i%4)*8+4)) & 0xF) +
           hex_tab.charAt((binarray[i>>2] >> ((i%4)*8  )) & 0xF);
  }
  return str;
}

/*
 * Convert an array of little-endian words to a base-64 string
 */
function binl2b64(binarray)
{
  var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
  var str = "";
  for(var i = 0; i < binarray.length * 4; i += 3)
  {
    var triplet = (((binarray[i   >> 2] >> 8 * ( i   %4)) & 0xFF) << 16)
                | (((binarray[i+1 >> 2] >> 8 * ((i+1)%4)) & 0xFF) << 8 )
                |  ((binarray[i+2 >> 2] >> 8 * ((i+2)%4)) & 0xFF);
    for(var j = 0; j < 4; j++)
    {
      if(i * 8 + j * 6 > binarray.length * 32) str += b64pad;
      else str += tab.charAt((triplet >> 6*(3-j)) & 0x3F);
    }
  }
  return str;
}
