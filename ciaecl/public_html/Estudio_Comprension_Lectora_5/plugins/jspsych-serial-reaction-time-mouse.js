/**
 * jspsych-serial-reaction-time
 * Josh de Leeuw
 *
 * plugin for running a serial reaction time task
 *
 * documentation: docs.jspsych.org
 *
 **/

jsPsych.plugins["serial-reaction-time-mouse"] = (function() {

  var plugin = {};

  plugin.info = {
    name: 'serial-reaction-time-mouse',
    description: '',
    parameters: {
      target: {
        type: jsPsych.plugins.parameterType.INT,
        pretty_name: 'Target',
        array: true,
        default: undefined,
        description: 'The location of the target. The array should be the [row, column] of the target.'
      },
      grid: {
        type: jsPsych.plugins.parameterType.BOOL,
        pretty_name: 'Grid',
        array: true,
        default: [[1,1,1,1]],
        description: 'This array represents the grid of boxes shown on the screen.'
      },
      grid_images: {
        type: jsPsych.plugins.parameterType.STRING,
        pretty_name: 'Grid images',
        array: true,
        default: [['imagen_1','imagen_2','imagen_3','imagen_4']],
        description: 'This array represents the links of de images in the grid.'
      },
      grid_allowed: {
        type: jsPsych.plugins.parameterType.BOOL,
        pretty_name: 'Grid allowed',
        array: true,
        default: [[1,1,1,1]],
        description: 'This array represents the pointer on each stimulus.'
      },
      grid_square_size_x: {
        type: jsPsych.plugins.parameterType.STRING,
        pretty_name: 'Grid square size in x',
        array: true,
        default: [[100,100,100,100]],
        description: 'The width in pixels of each square in the grid.'
      },
      grid_square_size_y: {
        type: jsPsych.plugins.parameterType.STRING,
        pretty_name: 'Grid square size in y',
        array: true,
        default: [[100,100,100,100]],
        description: 'The height in pixels of each square in the grid.'
      },
      border_spacing: {
        type: jsPsych.plugins.parameterType.INT,
        pretty_name: 'Border_spacing of Grid',
        default: 10,
        description: 'Border_spacing in pixels between each square in the grid.'
      },
      target_color: {
        type: jsPsych.plugins.parameterType.STRING,
        pretty_name: 'Target color',
        default: "#999",
        description: 'The color of the target square.'
      },
      response_ends_trial: {
        type: jsPsych.plugins.parameterType.BOOL,
        pretty_name: 'Response ends trial',
        default: true,
        description: 'If true, the trial ends after a mouse click.'
      },
      pre_target_duration: {
        type: jsPsych.plugins.parameterType.INT,
        pretty_name: 'Pre-target duration',
        default: 0,
        description: 'The number of milliseconds to display the grid before the target changes color.'
      },
      trial_duration: {
        type: jsPsych.plugins.parameterType.INT,
        pretty_name: 'Trial duration',
        default: null,
        description: 'How long to show the trial'
      },
      fade_duration: {
        type: jsPsych.plugins.parameterType.INT,
        pretty_name: 'Fade duration',
        default: null,
        description: 'If a positive number, the target will progressively change color at the start of the trial, with the transition lasting this many milliseconds.'
      },
      allow_nontarget_responses: {
        type: jsPsych.plugins.parameterType.BOOL,
        pretty_name: 'Allow nontarget response',
        default: false,
        description: 'If true, then user can make nontarget response.'
      },
      prompt: {
        type: jsPsych.plugins.parameterType.STRING,
        pretty_name: 'Prompt',
        default: null,
        description: 'Any content here will be displayed below the stimulus'
      },
    }
  }

  plugin.trial = function(display_element, trial) {

    var startTime = -1;
    var response = {
      rt: null,
      row: null,
      column: null
    }

    // display stimulus
    var stimulus = this.stimulus(trial.grid, trial.grid_images, trial.grid_allowed, trial.grid_square_size_x, trial.grid_square_size_y, trial.border_spacing);
    display_element.innerHTML = stimulus;


		if(trial.pre_target_duration <= 0){
			showTarget();
		} else {
			jsPsych.pluginAPI.setTimeout(function(){
				showTarget();
			}, trial.pre_target_duration);
		}

		//show prompt if there is one
    if (trial.prompt !== null) {
      display_element.insertAdjacentHTML('afterbegin', trial.prompt);
    }

		function showTarget(){
      var resp_targets;
      if(!trial.allow_nontarget_responses){
        resp_targets = [display_element.querySelector('#jspsych-serial-reaction-time-stimulus-cell-'+trial.target[0]+'-'+trial.target[1])]
      } else {
        resp_targets = [];
        for(var i=0; i<trial.grid_allowed.length; i++){
          for(var j=0; j<trial.grid_allowed[i].length; j++){
            if (trial.grid_allowed[i][j] == 1){
              resp_targets.push(display_element.querySelector('#jspsych-serial-reaction-time-stimulus-cell-'+i+'-'+j))
            }
          }
        }
        //resp_targets = display_element.querySelectorAll('.jspsych-serial-reaction-time-stimulus-cell');
        //resp_targets = [display_element.querySelector('#jspsych-serial-reaction-time-stimulus-cell-0-0')];      
      }
      for(var i=0; i<resp_targets.length; i++){
        resp_targets[i].addEventListener('mousedown', function(e){
          if(startTime == -1){
            return;
          } else {
            var info = {}
            info.row = e.currentTarget.getAttribute('data-row');
            info.column = e.currentTarget.getAttribute('data-column');
            info.rt = performance.now() - startTime;
            after_response(info);
          }
        });
      }

      startTime = performance.now();

      if(trial.fade_duration == null){
        //display_element.querySelector('#jspsych-serial-reaction-time-stimulus-cell-'+trial.target[0]+'-'+trial.target[1]).style.backgroundColor = trial.target_color;
      } else {
        //display_element.querySelector('#jspsych-serial-reaction-time-stimulus-cell-'+trial.target[0]+'-'+trial.target[1]).style.transition = "background-color "+trial.fade_duration;
        //display_element.querySelector('#jspsych-serial-reaction-time-stimulus-cell-'+trial.target[0]+'-'+trial.target[1]).style.backgroundColor = trial.target_color;
      }

			if(trial.trial_duration !== null){
				jsPsych.pluginAPI.setTimeout(endTrial, trial.trial_duration);
			}

		}

    function endTrial() {

      // kill any remaining setTimeout handlers
      jsPsych.pluginAPI.clearAllTimeouts();

      // gather the data to store for the trial
      var trial_data = {
        rt: response.rt,
				grid: trial.grid,
				target: trial.target,
        response: [parseInt(response.row,10), parseInt(response.column,10)],
        correct: response.row == trial.target[0] && response.column == trial.target[1]
      };

      // clear the display
      display_element.innerHTML = '';

      // move on to the next trial
      jsPsych.finishTrial(trial_data);

    };

    // function to handle responses by the subject
    function after_response(info) {

			// only record first response
      response = response.rt == null ? info : response;

      if (trial.response_ends_trial) {
        endTrial();
      }
    };

  };

  plugin.stimulus = function(grid, grid_images, grid_allowed, square_size_x, square_size_y, border_spacing, target, target_color, labels) {
    var stimulus = "<div id='jspsych-serial-reaction-time-stimulus' style='margin:auto; display: table; table-layout: fixed; border-spacing:"+border_spacing+"px'>";
      for(var i=0; i<grid.length; i++){
      stimulus += "<div class='jspsych-serial-reaction-time-stimulus-row' style='display:table-row;'>";
      for(var j=0; j<grid[i].length; j++){
        var classname = 'jspsych-serial-reaction-time-stimulus-cell';
        if (grid_allowed[i][j] == 1){
          stimulus += "<div class='"+classname+"' id='jspsych-serial-reaction-time-stimulus-cell-"+i+"-"+j+"' "+
          "data-row="+i+" data-column="+j+" "+
          "style='width:"+square_size_x[i][j]+"px; background: url("+grid_images[i][j]+"); background-size: "+ square_size_x[i][j] +"px "+ square_size_y[i][j] +"px; height:"+square_size_y[i][j]+"px; display:table-cell; vertical-align:middle; text-align: center; cursor: pointer;";
        } else {
          stimulus += "<div class='"+classname+"' id='jspsych-serial-reaction-time-stimulus-cell-"+i+"-"+j+"' "+
          "data-row="+i+" data-column="+j+" "+
          "style='width:"+square_size_x[i][j]+"px; background: url("+grid_images[i][j]+"); background-size: "+ square_size_x[i][j] +"px "+ square_size_y[i][j] +"px; height:"+square_size_y[i][j]+"px; display:table-cell; vertical-align:middle; text-align: center;";
        };

        if(grid[i][j] == 1){
          stimulus += "border: 0px solid black;"
        }
        if(typeof target !== 'undefined' && target[0] == i && target[1] == j){
          stimulus += "background-color: "+target_color+";"   
        }
        stimulus += "'>";
        if(typeof labels !=='undefined' && labels[i][j] !== false){
          stimulus += labels[i][j]
        }
        stimulus += "</div>";
      }
      stimulus += "</div>";
    }
    stimulus += "</div>";  
    return stimulus
  }

  return plugin;
})();
