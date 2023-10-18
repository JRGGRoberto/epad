/*
				=====================================================================
				Elusien's WebVfx framework for Shotcut (http://elusien.co.uk/shotcut)
				=====================================================================

	For a full description, including documentation and examples see the above website.
	
	This framework enables Shotcut HTML Overlay filters to be developed quickly using a modern browser,
	with all its development tools (e.g. using function key F12) at your disposal. Shotcut does not have any
	such tools, other than a basic console.log, and in many cases of error you just end up with a blank screen.
	
	You can style the HTML elements as normal using CSS then modify the properties you want to animate
	using this framework.
	
	When you apply this filter to a clip in Shotcut, you need to tick the box that says
	'Use WebVfx javascript extension' and confirm that you know how to use it.
	
	There are 3 parts to this framework two of which are exposed to the user via HTML tag parameters:
	
	1) Animation effects:
		This enables you to animate CSS properties for any of the HTML elements in the HTML Overlay filter.
		It also enables the use of "keyframes" for fine control of the animation. e.g.
				
				a) Fadeout an element:
					<div class='webvfx' data-animate='{0%: {opacity: 1;}, 100%: {opacity: 0%;}}'>
						FADING TEXT
					</div>
				b) Fadeout an element, then fade it back in:
					<div class='webvfx' data-animate='{0%: {opacity: 1;}, 50%: {opacity: 0%;}, 100%: {opacity: 1;}}'>
						TEXT FADING OUT THEN BACK IN
					</div>
				c) Change an element's colour, move it around, change it from a square shape to a circle. 
					<div  class='webvfx' data-animate=
						'{start: 0.2, end: 1.0, ease: "easeOutSine",
					       0%: {backgroundColor: #f00; left:  0px; top:  0px; borderRadius:  0%;},
					      25%: {backgroundColor: #00f; left:100px; top:  0px; borderRadius: 50%;},
						  50%: {backgroundColor: #0f0; left:200px; top:200px; borderRadius:  0%;},
						  75%: {backgroundColor: #f0f; left:  0px; top:200px; borderRadius: 50%;},
						 100%: {backgroundColor: #ff0; left:100px; top:  0px; borderRadius:  0%;}
					   }'>
						HI
					</div>

	2) Stopwatch effects:
		This enables you to have 1 or more stopwatches in the HTML Overlay filter. It also enables the
		use of "keyframes" for fine control of the stopwatches.
		
		A stopwatch consists of 4 elements specified using HTML '<span></span>' tags.
		<span> number 1 is the frame       number;
		<span> number 2 is the hour        number;
		<span> number 3 is the minute      number;
		<span> number 4 is the millisecond number
		
		Normally you would initialise each of the <span> elements by placing a zero (0) in it. Placing any
		other number will initialise it to that value. Leaving the <span> empty will hide it (see examples). e.g.
		
				a) Stopwatch showing frame-number, minutes and seconds:
					<div class="webvfx"	 data-stopwatch=''>
						Frame <span>0</span> => <span></span><span>00</span>m <span>00</span>s <span></span>
					</div>
					
				b) Stopwatch showing minutes and seconds, running for 120 seconds with various pauses and resumes:
				
					<div class="webvfx"	data-control='120:24' data-stopwatch=
						'{10%: {pause;},
						  20%: {resume;},
						  40%: {pause;},
						  60%: {resume: skip;},
						  80%: {pause;},
						  90%: {resume: 60000;}
						 }'>
						<span></span></span><span></span><span>00</span>m <span>00</span>s <span></span>
					</div>
	
	3) User-supplied effects:
		This enables you to provide your own javascript function to do something to the HTML. This function
		will be called for each frame with the parameters:
			time: 		  the "normalised time" of this frame (0.0 to 1.0);
			frame_number: the number of this frame
			frame_rate  : the frame-rate in frames per second
		
		To do this you need to create the javascript function, then add it to a GLOBAL-scope array called
		"webvfx_add_to_frame" e.g.
		
		<script>
			function flash(time, frame_number, frame_rate) {
				bulb = document.getElementById("bulb");
					bulb.style.opacity = ((frame_number % 10) < 5) ? 0.1 : 1.0;
			}
			webvfx_add_to_frame = [flash];
		<script>
			
 * The Creative Commons Attribution-ShareAlike 4.0 International Licence (CC BY-SA 4.0)
 * See https://creativecommons.org/licenses/by-sa/4.0/
 *
 * Copyright (c) 2018 - Elusien Entertainment
 *
 * Attribution — You must give appropriate credit, provide a link to the license,
 * and indicate if changes were made. You may do so in any reasonable manner,
 * but not in any way that suggests the licensor endorses you or your use.
 *
 * ShareAlike — If you remix, transform, or build upon the material, you must distribute
 * your contributions under the same license as the original.
 *
 * No additional restrictions — You may not apply legal terms or technological measures
 * that legally restrict others from doing anything the license permits.
 *
 * Notices:
 * You do not have to comply with the license for elements of the material in the public domain
 * or where your use is permitted by an applicable exception or limitation.
 * No warranties are given. The license may not give you all of the permissions necessary
 * for your intended use. For example, other rights such as publicity, privacy, or moral rights
 * may limit how you use the material.
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @version 1.8

*/
	var Elusien = {
		iter        : 0,
		niters      : 0,
		delay       : 0,
		frame_number: 0,
		frame_length: 0
	};
	
	function Easing_Funs(){
    /*
        Easing Equations v1.3, Oct. 29, 2002, Open source under the BSD License. 
        Copyright © 2001-2002 Robert Penner. All rights reserved.
  
        These tweening functions provide different flavors of math-based motion under a consistent API.
      
        Math.easingType(t,b,c,d)
            t: current time,
            b: beginning value  (i.e  value at time_start),
            c: change in value  (end_value - b), can be negative
            d: duration         (i.e. time_end - time_start)
  
        Type of easing  HTML data-easing value      Description
        --------------  ----------------------      -----------
            Linear      "linearTween"                           linear tweening - no easing is performed
            Quadratic   "easeInQuad"              t^2         acceleration from zero velocity
                        "easeOutQuad"             t^2         deceleration  to  zero velocity
                        "easeInOutQuad"           t^2         acceleration until halfway, then deceleration
            Cubic       "easeInCubic"             t^3         acceleration from zero velocity
                        "easeOutCubic"            t^3         deceleration  to  zero velocity
                        "easeInOutCubic"          t^3         acceleration until halfway, then deceleration
            Quartic     "easeInQuartic"           t^4         acceleration from zero velocity
                        "easeOutQuartic"          t^4         deceleration  to  zero velocity
                        "easeInOutQuartic"        t^4         acceleration until halfway, then deceleration
            Quintic     "easeInQuintic"           t^5         acceleration from zero velocity
                        "easeOutQuintic"          t^5         deceleration  to  zero velocity
                        "easeInOutQuintic"        t^5         acceleration until halfway, then deceleration
            Sinusoidal  "easeInSine"              sinusoidal  acceleration from zero velocity
                        "easeOutSine"             sinusoidal  deceleration  to  zero velocity
                        "easeInOutSine"           sinusoidal  acceleration until halfway, then deceleration
            Exponential "easeInExpo"              exponential acceleration from zero velocity
                        "easeOutExpo"             exponential deceleration  to  zero velocity
                        "easeInOutExpo"           exponential acceleration until halfway, then deceleration
            Circular    "easeInCirc"              circular    acceleration from zero velocity
                        "easeOutCirc"             circular    deceleration  to  zero velocity
                        "easeInOutCirc"           circular    acceleration until halfway, then deceleration
            Bounce      "easeInBounce"            elastic     bounce, then acceleration from zero velocity
                        "easeOutBounce"           elastic     deceleration  to  zero velocity, then bounce
                        "easeInOutBounce"         elastic     bounce, then acceleration until halfway, then deceleration, then bounce
          
      Changes:
          1.3 - tweaked the exponential easing functions to make endpoints exact
          1.2 - inline optimizations (changing t and multiplying in one step)--thanks to Tatsuo Kato for the idea
  
      Discussed in Chapter 7 of Robert Penner's Programming Macromedia Flash MX (including graphs of the easing equations)
      http://www.robertpenner.com/profmx
      http://www.amazon.com/exec/obidos/ASIN/0072223561/robertpennerc-20
    */

			this.linearTween    = function (t, b, c, d) {return  c *  t/d                         + b;};
			this.easeInQuad     = function (t, b, c, d) {return  c * (t/=d)         *t            + b;};
			this.easeOutQuad    = function (t, b, c, d) {return -c * (t/=d)         *(t-2)        + b;};
			this.easeInOutQuad  = function (t, b, c, d) {return ((t/=d/2) < 1) ? c/2*t*t          + b : -c/2*((--t)*(t-2)    - 1) + b;};
			this.easeInCubic    = function (t, b, c, d) {return c *  (t/=d)         *t*t          + b;};
			this.easeOutCubic   = function (t, b, c, d) {return c * ((t=t/d-1)      *t*t + 1)     + b;};
			this.easeInOutCubic = function (t, b, c, d) {return ((t/=d/2) < 1) ? c/2*t*t*t        + b :  c/2*((t-=2)*t*t     + 2) + b;};
			this.easeInQuart    = function (t, b, c, d) {return  c *  (t/=d)        *t*t*t        + b;};
			this.easeOutQuart   = function (t, b, c, d) {return -c * ((t=t/d-1)     *t*t*t - 1)   + b;};
			this.easeInOutQuart = function (t, b, c, d) {return ((t/=d/2) < 1) ? c/2*t*t*t*t      + b : -c/2*((t-=2)*t*t*t   - 2) + b;};
			this.easeInQuint    = function (t, b, c, d) {return  c * (t/=d)         *t*t*t*t      + b;};
			this.easeOutQuint   = function (t, b, c, d) {return  c * ((t=t/d-1)     *t*t*t*t + 1) + b;};
			this.easeInOutQuint = function (t, b, c, d) {return ((t/=d/2) < 1) ? c/2*t*t*t*t*t    + b :  c/2*((t-=2)*t*t*t*t + 2) + b;};
			this.easeInSine     = function (t, b, c, d) {return -c   *  Math.cos(t/d * (Math.PI/2)) + c + b;};
			this.easeOutSine    = function (t, b, c, d) {return  c   *  Math.sin(t/d * (Math.PI/2))     + b;};
			this.easeInOutSine  = function (t, b, c, d) {return -c/2 * (Math.cos(t/d *  Math.PI) - 1)   + b;};
			this.easeInExpo     = function (t, b, c, d) {return (t===0) ? b   : c *   Math.pow(2, 10 * (t/d - 1)) + b;};
			this.easeOutExpo    = function (t, b, c, d) {return (t==d)  ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;};
			this.easeInOutExpo  = function (t, b, c, d) {return (t===0) ? b   : ((t==d) ? b+c : (((t/=d/2) < 1) ? c/2 * Math.pow(2, 10 * (t - 1)) + b : c/2*(-Math.pow(2, -10 * --t) + 2) + b));};
			this.easeInCirc     = function (t, b, c, d) {return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;};
			this.easeOutCirc    = function (t, b, c, d) {return  c *  Math.sqrt(1 - (t=t/d-1)*t)   + b;};
			this.easeInOutCirc  = function (t, b, c, d) {return ((t/=d/2) < 1) ? -c/2 * (Math.sqrt(1 - t*t) - 1) + b : c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;};
			this.easeInBounce   = function (t, b, c, d) {return (t===0) ? b :  (((t/=d)   == 1) ? b + c :                -(c * Math.pow(2,  10 * (t -= 1)) * Math.sin((t * d - (d*0.3    /4)) * (2 * Math.PI) / (d*0.3    )))           + b);};
			this.easeOutBounce  = function (t, b, c, d) {return (t===0) ? b :  (((t/=d/2) == 2) ? b + c :                 (c * Math.pow(2, -10 *  t      ) * Math.sin((t * d - (d*0.3    /4)) * (2 * Math.PI) / (d*0.3    )))       + c + b);};
			this.easeInOutBounce= function (t, b, c, d) {return (t===0) ? b :  (((t/=d/2) == 2) ? b + c : ((t<1) ? -0.5 * (c * Math.pow(2,  10 * (t -= 1)) * Math.sin((t * d - (d*0.3*1.5/4)) * (2 * Math.PI) / (d*0.3*1.5)))           + b :
																															(c * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * d - (d*0.3*1.5/4)) * (2 * Math.PI) / (d*0.3*1.5))) * 0.5 + c + b));};
    }      // #################### END OF Easing_Funs CONSTRUCTOR ####################

// ######################### parse SRT/VTT subtitle files ###########################


	function timeInMs(timestamp) {
		if (!isNaN(timestamp)) {return timestamp;}

		var match = timestamp.match(/^(?:(\d{2,}):)?(\d{2}):(\d{2})[,.](\d{3})$/);

		if (!match) {
			throw new Error('Invalid SRT or VTT time format: "' + timestamp + '"');
		}

		var hours        = match[1] ? parseInt(match[1], 10) * 3600000 : 0;
		var minutes      =            parseInt(match[2], 10) *   60000;
		var seconds      =            parseInt(match[3], 10) *    1000;
		var milliseconds =            parseInt(match[4], 10);

		return hours + minutes + seconds + milliseconds;
	}

    /**
     * Converts SubRip subtitles into an array of objects
     * [{
     *     id:        `Number of subtitle`
     *     startTime: `Start time of subtitle`
     *     endTime:   `End time of subtitle
     *     text: `Text of subtitle`
     * }]
     *
     * @param  {String}  srt_str : The SubRip subtitles string (can handle v simple VTT strings too)
     * @return {Array}   cues    : An array of "Cue" structures, 1 for each subtitle.
     **/
    function fromSrt(srt_str) {

//var RE =                /^((?:\d{2,}:)?\d{2}:\d{2}[,.]\d{3}) --> ((?:\d{2,}:)?\d{2}:\d{2}[,.]\d{3})(?: (.*))/g;
		var regex = /(\d+)\n((?:\d{2,}:)?\d{2}:\d{2}[,.]\d{3}) --> ((?:\d{2,}:)?\d{2}:\d{2}[,.]\d{3})/g;

/*	e.g.	(for .srt file)
			12
			00:00:23,500 --> 00:00:25,100
			<b>What's happening?</b>
			
	or for .vtt file
			12
			00:00:23.500 --> 00:00:25.100  region:bill align:right
			<v bill><b>What's happening?</b>
*/		
		
        var parts = srt_str.replace(/\r/g, '').split(regex);
		parts.shift();
		
        var cues = [];
		var i    = 0;
        while (i < parts.length) {
            cues.push({
				processing: 0,		// -1 = finished; 0 = not started; 1 = in progress
				start     : 0,		// startTime in NORMALISED time units
				end       : 0,		// endTime   in NORMALISED time units
                id        :          parts[i++].trim(),
                startTime : timeInMs(parts[i++].trim()),
                endTime   : timeInMs(parts[i++].trim()),
                text      :          parts[i++].trim()
            });
        }

//console.log(cues);
        return cues;
    }

// ##################################### END OF SUBTITLE PARSING ################################

// The EXIF stuff is not used, it is too difficult to implement in Javascript for shotcut.

/*
	From the EXIF standard documentation
	(http://web.archive.org/web/20131018091152/http://exif.org/Exif2-2.PDF)
	Table 18 Tag Support Levels (5) 
	Orientation:
	The image orientation viewed in terms of rows and columns.
	Tag = 274 (112 Hex)
	Type = SHORT
	Count = 1
	Default = 1
	1 = The 0th row is the visual top             of the image, and the 0th column is the visual left-hand  side. (Normal)
	2 = The 0th row is the visual top             of the image, and the 0th column is the visual right-hand side. 
	3 = The 0th row is the visual bottom          of the image, and the 0th column is the visual right-hand side. 
	4 = The 0th row is the visual bottom          of the image, and the 0th column is the visual left-hand  side.
	5 = The 0th row is the visual left-hand  side of the image, and the 0th column is the visual top.
	6 = The 0th row is the visual right-hand side of the image, and the 0th column is the visual top.
	7 = The 0th row is the visual right-hand side of the image, and the 0th column is the visual bottom.
	8 = The 0th row is the visual left-hand  side of the image, and the 0th column is the visual bottom.
	Other = reserved 
*/

	var exif_orientations = [
		'scale( 1, 1) rotate(  0deg)',
		'scale( 1, 1) rotate(  0deg)',
		'scale(-1, 1) rotate(  0deg)',
		'scale( 1, 1) rotate(180deg)',
		'scale( 1,-1) rotate(  0deg)',
		'scale(-1, 1) rotate( 90deg)',
		'scale( 1, 1) rotate( 90deg)',
		'scale(-1, 1) rotate(-90deg)',
		'scale( 1, 1) rotate(-90deg)'
	];

	function _arrayBufferToBase64( buffer ) {	// Used in EXIF code - CAN IGNORE
		var binary = '';
		var bytes = new Uint8Array( buffer );
		var len = bytes.byteLength;
		for (var i = 0; i < len; i++) {binary += String.fromCharCode( bytes[ i ] );}
		return window.btoa( binary );
	}

	function exif_orientation(filename) {		// Used in EXIF code - CAN IGNORE
		if (!(window.File && window.FileReader && window.FileList && window.Blob)) {
			alert('The File APIs are not fully supported in this browser.');
		}
		var file = new File([""], filename);
//console.log('EXIF:' + filename + ': ' + file.name);
		var file_reader = new FileReader();
		file_reader.onload = function() {
//console.log('OK:' + this.readyState + ', ' + this.error  + '; ' + this.result.length);
			var scanner = new DataView(this.result);
			var idx = 0;
			var value = 1; // Non-rotated is the default
			if(this.result.length < 2 || scanner.getUint16(idx) != 0xFFD8) {
				return 0; // Not a JPEG
			}
			idx += 2;
			var maxBytes = scanner.byteLength;
			while(idx < maxBytes - 2) {
				var uint16 = scanner.getUint16(idx);
				idx += 2;
				switch(uint16) {
					case 0xFFE1: // Start of EXIF
						var exifLength = scanner.getUint16(idx);
						maxBytes = exifLength - idx;
						idx += 2;
						break;
					case 0x0112: // Orientation tag
						// Read the value, its 6 bytes further out
						// See page 102 at the following URL
						// http://www.kodak.com/global/plugins/acrobat/en/service/digCam/exifStandard2.pdf
						value = scanner.getUint16(idx + 6, false);
						maxBytes = 0; // Stop scanning
						break;
				}
			}
		};
		file_reader.readAsArrayBuffer(file);
	}

	function rand_between(xmin, xmax) {	return Math.random() * (xmax - xmin) + xmin; }
	
    function Producer(params) {

/*
       ==============================================================================================================
        Description
        -----------
        This function is called to save its parameters as its properties. These are required by the
        render function in order to animate the objects on the screen by manipulating certain of their CSS properties.

        Parameters  Description
        ----------  -----------
        params      An object containing all the parameters
        ==============================================================================================================
*/

        this.params = params;  // Add params objects as a property of the Producer class
    }       // #################### END OF Producer CONSTRUCTOR ####################
    
    Producer.prototype.render = function(time) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called once for each frame to manipulate the various objects' CSS properties by 1 increment.
        By using "prototype" it is stored in the Producer object as a method called "render".
        This is the main function, since it is where the animated frames are produced.
        
        Parameters          Description
        ----------          -----------
        time                The current normalised (between 0.0 and 1.0) time. This is incremented on each call by an
                            amount equal to 1/(duration*framerate), where duration = the length of the clip in seconds
                            and framerate is the number of frames per second.                           
        ==============================================================================================================
*/
        var property;
		var startval;
		var changeval;
        var propertyval;
        var i;
		var j;
        var k;
        var t = time;
		var duration;
        var animate;
		var start;
		var end;
		var ease;
		var keyftime;
		var keystart;
		var keyend;
		var kt;
		var kd;
		var prop;
		var fprop;
		var tprop;
		var fp     = [];
		var tp     = [];
		var aprops = [];
		var from   = {};
		var to     = {};

		Elusien.frame_length = t / (++Elusien.frame_number);
		if (typeof webvfx_add_to_frame !=='undefined') {for (i = 0; i < webvfx_add_to_frame.length; i++) {webvfx_add_to_frame[i](time, this.params.browser, Elusien.frame_number, Elusien.frame_rate);}}

        for (var param in this.params) {
			if (typeof this.params[param].animate != "undefined"){
				animate    = this.params[param].animate;
				start      = animate.start;
				end        = animate.end;
				ease       = animate.ease;
				duration   = end - start;
				aprops     = Object.getOwnPropertyNames(this.params[param].animate).sort();
				if ((t >= start) && (t <= end)) {
// The next statement is to get over the problem that the time never reaches 1.0. the last time is for the last frame
// which can appear up to 1/frame-rate seconds before 1.0. Since we do not know the framerate, assume it is 24fps.
					if ((end-t) < 2*Elusien.frame_length){t = end;}
					j = 0;
					for (k = 0; k < aprops.length; k++) {
						if (aprops[k].match(/^\d+(.\d)*$/) !== null) {
							prop     = +aprops[k];
							keyftime = (prop * duration / 100) + start;
							if (keyftime <= t) {
								kt       = t - keyftime;
								keystart = k;
								keyend   = keystart+1;
								if (aprops[keyend].match(/^\d+(.\d)*$/) === null) {
									keyend = keystart;
									kt     = 1.0;
									kd     = kt;
								} else {
									kd     = (+aprops[keyend] * duration / 100) - (+aprops[keystart] * duration / 100);
								}
							}
						}
					}
//console.log('DEBUG: prop=' + prop + ', keystart=' + keystart + ', keyend=' + keyend);
					from        = animate[aprops[keystart]];
					  to        = animate[aprops[keyend]];
					fp          = Object.getOwnPropertyNames(from);
					tp          = Object.getOwnPropertyNames( to );
					for (j=0; j<fp.length; j++) {
						property    = fp[j];
						propertyval = " ";
						for (i = 0; i < from[property].length; i++) {
							fprop = from[property][i];
//							if(typeof fprop == "string"){fprop = fprop.trim();} // do NOT trim
							tprop =   to[property][i];
//							if(typeof tprop == "string"){tprop = tprop.trim();} // do NOT trim
							if (typeof fprop == "string" && fprop[0] != '#') {
								propertyval += fprop;
							} else if ((typeof fprop == "string") && (fprop[0] == '#')) {
								propertyval += "rgb(";
								startval  = parseInt(fprop.substring(1,3),16);
								changeval = parseInt(tprop.substring(1,3),16) - startval;
								propertyval += Math.floor(this.params[param].easing[ease](kt, +startval, +changeval, kd)) + ',';
								startval  = parseInt(fprop.substring(3,5),16);
								changeval = parseInt(tprop.substring(3,5),16) - startval;
								propertyval += Math.floor(this.params[param].easing[ease](kt, +startval, +changeval, kd)) + ',';
								startval  = parseInt(fprop.substring(5,7),16);
								changeval = parseInt(tprop.substring(5,7),16) - startval;
								propertyval += Math.floor(this.params[param].easing[ease](kt, +startval, +changeval, kd)) + ')';
							} else {
								startval     = fprop;
								changeval    = tprop - startval;
								propertyval += this.params[param].easing[ease](kt, +startval, +changeval, kd);
							}
						}						
//console.log(time +  "|DEBUG: property=" + property + ": " + propertyval);
						this.params[param].style[property] = propertyval;
					}
				}
			} else if (typeof  this.params[param].stopwatch  != "undefined"){
				run_stopwatch (this.params[param].stopwatch , this.params[param].sw_params, time, Elusien.frame_number, Elusien.frame_rate);
			} else if (typeof  this.params[param].slideshow  != "undefined"){
				run_slideshow (this.params[param].slideshow , this.params[param].ss_params, time, Elusien.frame_number, Elusien.frame_rate);
			} else if (typeof  this.params[param].explosion  != "undefined"){
				run_explosion (this.params[param].explosion , this.params[param].ex_params, time, Elusien.frame_number, Elusien.frame_rate);
			} else if (typeof  this.params[param].rolling    != "undefined"){
				run_rolling   (this.params[param].rolling   , this.params[param].rl_params, time, Elusien.frame_number, Elusien.frame_rate);
			} else if (typeof  this.params[param].fragment   != "undefined"){
				run_fragment  (this.params[param].fragment  , this.params[param].fg_params, time, Elusien.frame_number, Elusien.frame_rate);
			} else if (typeof  this.params[param].subtitle   != "undefined"){
				run_subtitle  (this.params[param].subtitle  , this.params[param].st_params, time, Elusien.frame_number, Elusien.frame_rate);
			} else if (typeof  this.params[param].typewrite  != "undefined"){
				run_typewriter(this.params[param].typewriter, this.params[param].tw_params, time, Elusien.frame_number, Elusien.frame_rate);
			} else if (typeof  this.params[param].credits    != "undefined"){
				run_credits   (this.params[param].credits,    this.params[param].vc_params, time, Elusien.frame_number, Elusien.frame_rate);
			}

        }
    };      // #################### END OF render ####################


    function credits_to_JSON_string(data_credits) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called once to create the JSON string from the user's credits request..
        
        Parameters          Description
        ----------          -----------
        data_credits    The string the user provided on the "data-credits" attribute in the HTML.                           
        ==============================================================================================================
*/
        return data_credits.replace(                  /\n/g, ' ')
													 .replace(                /(['"])/g, '')
                           .replace(                /\s+:/g, ': ')
                           .replace(              /\s{2,}/g, ' ')
													 .replace(      /([a-z0-9_.]+):/ig, '"$1":')
													 .replace(        /:\s*([^:},\s}]*)\s*,{0,1}/g, ':"$1",')
													 .replace(            /[;,]\s*}/g, '}');
	}
	
    function typewriter_to_JSON_string(data_typewriter) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called once to create the JSON string from the user's typewriter request..
        
        Parameters          Description
        ----------          -----------
        data_typewriter    The string the user provided on the "data-typewriter" attribute in the HTML.                           
        ==============================================================================================================
*/
        return data_typewriter.replace(                  /\n/g, ' ')
							 .replace(                /(['"])/g, '')
                             .replace(                /\s+:/g, ': ')
                             .replace(              /\s{2,}/g, ' ')
						     .replace(      /([a-z0-9_.]+):/ig, '"$1":')
						     .replace(        /:\s*([^:},\s}]*)\s*,{0,1}/g, ':"$1",')
						     .replace(            /[;,]\s*}/g, '}');
	}
	

    function slideshow_to_JSON_string(data_slideshow) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called once to create the JSON string from the user's slideshow request..
        
        Parameters          Description
        ----------          -----------
        data_animate        The string the user provided on the "data-slideshow" attribute in the HTML.                           
        ==============================================================================================================
*/
        return data_slideshow.replace(                  /\n/g, ' ')
							 .replace(                /(['"])/g, '')
                             .replace(                /\s+:/g, ': ')
                             .replace(              /\s{2,}/g, ' ')
						     .replace(      /([a-z0-9_.]+):/ig, '"$1":')
						     .replace(        /:\s*([^:},\s}]*)\s*,{0,1}/g, ':"$1",')
						     .replace(            /[;,]\s*}/g, '}');
	}
	
    function animate_to_JSON_string(data_animate) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called once to create the JSON string from the user's animation request..
        
        Parameters          Description
        ----------          -----------
        data_animate        The string the user provided on the "data-animate" attribute in the HTML.                           
        ==============================================================================================================
*/
        return data_animate.replace(                  /\n/g, ' ')
                           .replace(                /\s+:/g, ': ')
                           .replace(              /\s{2,}/g, ' ')
                           .replace(    /(\d\d\d)(.\d*){0,1}%:/g, '$1$2:')
						   .replace(  /(\D)(\d\d)(.\d*){0,1}%:/g, '$10$2$3:')
						   .replace(  /(\D\D)(\d)(.\d*){0,1}%:/g, '$100$2$3:')
						   .replace(      /([a-z0-9_.]+):/ig, '"$1":')
						   .replace(        /:([^:]*)\s*;/g, ':"$1",')
						   .replace(            /[;,]\s*}/g, '}');
	}
	
    function explosion_to_JSON_string(data_explosion) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called once to create the JSON string from the user's explosion request..
        
        Parameters          Description
        ----------          -----------
        data_explosion      The string the user provided on the "data-explode" attribute in the HTML.                           
        ==============================================================================================================
*/
        return data_explosion.replace(                  /\n/g, ' ')						// Replace newline by space
							 .replace(                /(['"])/g, '')					// Remove quotes
                             .replace(                /\s+:/g, ': ')					// Remove spaces before ':' and append a space
                             .replace(              /\s{2,}/g, ' ')						// replace multiple spaces by a single space
                             .replace(    /(\d\d\d)(.\d*){0,1}%:/g, '$1$2:')			// These 3 lines convert keyframes to
						     .replace(  /(\D)(\d\d)(.\d*){0,1}%:/g, '$10$2$3:')			// 	numbers such as:
						     .replace(  /(\D\D)(\d)(.\d*){0,1}%:/g, '$100$2$3:')		//		050.1276 (get rid of '%')
						     .replace(  /(\d\d\d)(.\d*){0,1}:\s+([a-z]*)/g, '$1$2: $3')	// Add a space after the keyframe
						     .replace(      /([a-z0-9_.]+):/ig, '"$1":')				// Put double-quotes around property names
						     .replace(        /:\s*([^:}," ]*)\s*/g, ': "$1"')			// Put double-quotes around property values
						     .replace(            /[;,]\s*}/g, '}');					// Remove last ',' or ';' before a '}'
	}
	
    function rolling_to_JSON_string(data_rolling) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called once to create the JSON string from the user's rolling request..
        
        Parameters          Description
        ----------          -----------
        data_rolling        The string the user provided on the "data-roll" attribute in the HTML.                           
        ==============================================================================================================
*/
        return data_rolling.replace(                  /\n/g, ' ')						// Replace newline by space
							 .replace(                /(['"])/g, '')					// Remove quotes
                             .replace(                /\s+:/g, ': ')					// Remove spaces before ':' and append a space
                             .replace(              /\s{2,}/g, ' ')						// replace multiple spaces by a single space
                             .replace(    /(\d\d\d)(.\d*){0,1}%:/g, '$1$2:')			// These 3 lines convert keyframes to
						     .replace(  /(\D)(\d\d)(.\d*){0,1}%:/g, '$10$2$3:')			// 	numbers such as:
						     .replace(  /(\D\D)(\d)(.\d*){0,1}%:/g, '$100$2$3:')		//		050.1276 (get rid of '%')
						     .replace(  /(\d\d\d)(.\d*){0,1}:\s+([a-z]*)/g, '$1$2: $3')	// Add a space after the keyframe
						     .replace(      /([a-z0-9_.]+):/ig, '"$1":')				// Put double-quotes around property names
						     .replace(        /:\s*([^:}," ]*)\s*/g, ': "$1"')			// Put double-quotes around property values
						     .replace(            /[;,]\s*}/g, '}');					// Remove last ',' or ';' before a '}'
	}
	
    function fragment_to_JSON_string(data_fragment) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called once to create the JSON string from the user's fragmentation request..
        
        Parameters          Description
        ----------          -----------
        data_fragment       The string the user provided on the "data-fragment" attribute in the HTML.                           
        ==============================================================================================================
*/
        return data_fragment.replace(                  /\n/g, ' ')						// Replace newline by space
							.replace(                /(['"])/g, '')					// Remove quotes
                            .replace(                /\s+:/g, ': ')					// Remove spaces before ':' and append a space
                            .replace(              /\s{2,}/g, ' ')						// replace multiple spaces by a single space
                            .replace(    /(\d\d\d)(.\d*){0,1}%:/g, '$1$2:')			// These 3 lines convert keyframes to
							.replace(  /(\D)(\d\d)(.\d*){0,1}%:/g, '$10$2$3:')			// 	numbers such as:
							.replace(  /(\D\D)(\d)(.\d*){0,1}%:/g, '$100$2$3:')		//		050.1276 (get rid of '%')
							.replace(  /(\d\d\d)(.\d*){0,1}:\s+([a-z]*)/g, '$1$2: $3')	// Add a space after the keyframe
							.replace(      /([a-z0-9_.]+):/ig, '"$1":')				// Put double-quotes around property names
							.replace(        /:\s*([^:}," ]*)\s*/g, ': "$1"')			// Put double-quotes around property values
							.replace(            /[;,]\s*}/g, '}');					// Remove last ',' or ';' before a '}'
	}
	

    function stopwatch_to_JSON_string(data_stopwatch) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called once to create the JSON string from the user's animation request..
        
        Parameters          Description
        ----------          -----------
        data_animate        The string the user provided on the "data-animate" attribute in the HTML.                           
        ==============================================================================================================
*/
        return data_stopwatch.replace(                     /\n/g, ' ')
                             .replace(                   /\s+:/g, ': ')
                             .replace(                 /\s{2,}/g, ' ')
						     .replace(              /pause\s*;/g, 'pause: normal;')
						     .replace(             /resume\s*;/g, 'resume: normal;')
                             .replace(  /(\d\d\d)(.\d*){0,1}%:/g, '$1$2:')
						     .replace(/(\D)(\d\d)(.\d*){0,1}%:/g, '$10$2$3:')
						     .replace(/(\D\D)(\d)(.\d*){0,1}%:/g, '$100$2$3:')
						     .replace(        /([a-z0-9_.]+):/ig, '"$1":')
						     .replace(           /:([^:]*)\s*;/g, ':"$1",')
						     .replace(               /[;,]\s*}/g, '}');
	}

			
	function format_explosion_data(explosion, ex_params){

//			explosion_data.element  is explosions[ex];
//			explosion_data.sequence is explode[ex];
//			explosion_data.spans becomes the span elements, which are the individual characters of the text.

		var chars    = explosion.innerHTML.split('');
		var width    = document.documentElement.clientWidth;	//"innerwidth"  in window ? window.innerwidth  : document.documentElement.offsetwidth;
		var height   = document.documentElement.clientHeight;	//"innerHeight" in window ? window.innerHeight : document.documentElement.offsetHeight;
		var mfact    = 2.0;
		var xmin     = -mfact * width;
		var xmax     =  mfact * width;
		var ymin     = -mfact * height;
		var ymax     =  mfact * height;
		var spantext = [];
		var tag      = false;
		
		for (var i=0; i<chars.length; i++) {
			if (chars[i] == '<') {
				tag = true;
			}
			if (!tag) {	// A single space is ignored in an inline-block, so convert it to a non-breaking space instead.
				spantext.push('<span class="e_x_p_l_o_d_e">', (chars[i] != ' ' ? chars[i] : '&nbsp'), '</span>');
			} else {
				spantext.push(chars[i]);			
			}
			if (chars[i] == '>') {
				tag = false;
			}
		}
		explosion.innerHTML = spantext.join('');
		ex_params.spans     = explosion.getElementsByClassName('e_x_p_l_o_d_e');
//console.log('ex_params.begin=', ex_params.begin, ', ex_params.state=', ex_params.state, 'ex_params.trans_end=', ex_params.trans_end);					
//console.log(ex_params);
		for (i = 0; i < ex_params.spans.length; i++)  {
			ex_params.styles[i]         = ex_params.spans[i].style;
			ex_params.coords[i]         = new Coords(rand_between(xmin, xmax),
													 rand_between(ymin, ymax),
													 (Math.random() < 0.5 ? 0 : 4),
													 i / ex_params.spans.length);
			ex_params.styles[i].display = 'inline-block';
			ex_params.styles[i].margin  = 0;
			ex_params.styles[i].padding = 0;
			ex_params.styles[i].border  = 0;
			ex_params.styles[i].opacity = (ex_params.explode.begin == 'visible') ? 1.0 : 0.0;
		}
		return;
	}

			
	function format_rolling_data(rolling, rl_params){

//			rolling_data.element  is explosions[ex];
//			rolling_data.sequence is explode[ex];
//			rolling_data.spans becomes the span elements, which are the individual characters of the text.


/*
 *	https://codepen.io/kh-mamun/pen/NdwZdW
*/

		var chars    = rolling.innerHTML.trim().split('');
		var spantext = [];
		var tag      = false;

console.log(rolling);
console.log(chars);
		for (var i=0; i<chars.length; i++) {
			if (chars[i] == '<') {
				tag = true;
			}
			if (!tag) {	// A single space is ignored in an inline-block, so convert it to a non-breaking space instead.
				spantext.push('<span class="f_l_o_w" style="text-decoration: inherit">', (chars[i] != ' ' ? chars[i] : '&nbsp'), '</span>');
			} else {
				spantext.push(chars[i]);			
			}
			if (chars[i] == '>') {
				tag = false;
			}
		}
		rl_params.originalHTML = rolling.innerHTML;
		rolling.innerHTML = spantext.join('');
		rl_params.spans     = rolling.getElementsByClassName('f_l_o_w');
//console.log('rl_params.begin=', rl_params.begin, ', rl_params.state=', rl_params.state, 'rl_params.trans_end=', rl_params.trans_end);					
//console.log(JSON.stringify(rl_params, null, 4));
console.log(rolling);
			rl_params.xform = [];
		for (i = 0; i < rl_params.spans.length; i++)  {
			rl_params.xform[i]         = new Xform(0);
			
			rl_params.coords[i]        = new Coords(rl_params.animparams[0].translate[0],
																							rl_params.animparams[0].translate[1],
																							rl_params.animparams[0].scale,
																							i / rl_params.spans.length,
																							rl_params.animparams[0].opacity,
																							rl_params.animparams[0].rotate
																						 ); // Initial (flow) or final (roll) translate (x, y)
			
			rl_params.coords[i].k       = 0;																		// This keyframe
			rl_params.coords[i].p       = rl_params.animparams[0].pcnt/100;     // THIS keyframe's percent (as a decimal 0 to 1)
			rl_params.coords[i].np      = rl_params.animparams[1].pcnt/100;			// the NEXT keyframe's percent (as a decimal 0 to 1)
			rl_params.coords[i].nx      = rl_params.animparams[1].translate[0];
			rl_params.coords[i].ny      = rl_params.animparams[1].translate[1];
			rl_params.coords[i].nz      = rl_params.animparams[1].scale;
			rl_params.coords[i].no      = rl_params.animparams[1].opacity;
			rl_params.coords[i].nr      = rl_params.animparams[1].rotate;
			
			rl_params.styles[i]         = rl_params.spans[i].style;
			rl_params.styles[i].display = 'inline-block';
			rl_params.styles[i].margin  = 0;
			rl_params.styles[i].padding = 0;
			rl_params.styles[i].border  = 0;
			rl_params.styles[i].opacity = (rl_params.roll.begin == 'visible') ? 1.0 : 0.0;
		}
console.log(rl_params);

		return;
	}
			
	function format_typewriter_data(typewriter, tw_params){

//			typewriter_data.element  is typewriters[tw];
//			typewriter_data.sequence is typewrite[tw];
//			typewriter_data.spans becomes the span elements, which are the individual characters of the text.

		var chars    = typewriter.innerHTML.split('');
		var spantext = [];
		var tag      = false;

		for (var i=0; i<chars.length; i++) {
			if (chars[i].charCodeAt(0) < 32) { continue; }
			if (chars[i] == '<') { tag = true; }
			if (!tag) {	// A single space is ignored in an inline-block, so convert it to a non-breaking space instead.
				spantext.push('<span class="_typewriter_">', (chars[i] != ' ' ? chars[i] : '&nbsp;'), '</span>');
			} else {
				spantext.push(chars[i]);			
			}
			if (chars[i] == '>') {
				tag = false;
			}
		}
		typewriter.innerHTML = spantext.join('');
		tw_params.spans      = typewriter.getElementsByClassName('_typewriter_');
//console.log(tw_params);
		for (i = 0; i < tw_params.spans.length; i++)  {
			tw_params.cstyle[i]                       = window.getComputedStyle(tw_params.spans[i], null);
			if (i === 0) { tw_params.borderRightColor = tw_params.cstyle[0].borderRightColor; }
			tw_params.style[i]                   = tw_params.spans[i].style;
			tw_params.style[i].display           = 'inline-block';
			tw_params.style[i].visibility        = 'hidden';
			tw_params.style[i].borderRightColor  = 'transparent';
			tw_params.style[i].borderLeftColor   = 'transparent';
			tw_params.style[i].borderBottomColor = 'transparent';
			tw_params.style[i].borderTopColor    = 'transparent';
//			tw_params.style[i].margin     = 0;
//			tw_params.style[i].padding    = 0;
		}
		tw_params.innerHTML0          = tw_params.spans[0].innerHTML;
		tw_params.spans[0].innerHTML  = '&nbsp;';
		tw_params.inc                 = (tw_params.typewrite.end - tw_params.typewrite.start) / (tw_params.spans.length + tw_params.typewrite.stx + tw_params.typewrite.etx);
		
		return;
	}
			
	function format_credits_data(credits, vc_params){

			var rows = credits.rows;
			vc_params.element        = credits;
			vc_params.style          = credits.style;
			vc_params.window_height  = document.documentElement.clientHeight;
			vc_params.credits_height = credits.offsetHeight;
			vc_params.start          = [];
			vc_params.end            = [];
			for (var i = 0; i< rows.length; i++){
				vc_params.start[i]     = (i === 0 ? 0 : vc_params.start[i-1]) + rows[i].offsetHeight / (vc_params.credits_height + vc_params.window_height);
				vc_params.end  [i]     = vc_params.start[i]               + vc_params.credits_height / (vc_params.credits_height + vc_params.window_height);	
			}

		return;
	}

			
	function format_fragment_data(fragment, fg_params){

//			fragment_data.element  is fragments[fg];
//			fragment_data.sequence is fragment[fg];
//			fragment_data.divs becomes the div elements, which are the clipped elements.

		var parent   = fragment.parentNode;
		var width    = document.documentElement.clientWidth;	//"innerwidth"  in window ? window.innerwidth  : document.documentElement.offsetwidth;
		var height   = document.documentElement.clientHeight;	//"innerHeight" in window ? window.innerHeight : document.documentElement.offsetHeight;
		var ndivs    = fg_params.fragment.nv * fg_params.fragment.nh;
		var w        = fragment.offsetWidth;
		var h        = fragment.offsetHeight;
		var wclip    = w / fg_params.fragment.nv;
		var hclip    = h / fg_params.fragment.nh;
		var mfact    = 2.0;
		var xmin     = -mfact * width;
		var xmax     =  mfact * width;
		var ymin     = -mfact * height;
		var ymax     =  mfact * height;
		var ndiv     = -1;

		fragment.style.opacity = 0.0;
		for (var i=0; i<fg_params.fragment.nh; i++) {
			for (var j=0; j<fg_params.fragment.nv; j++) {
				ndiv++;
				fg_params.divs[ndiv]           = parent.appendChild(fragment.cloneNode(true));
				fg_params.divs[ndiv].removeAttribute('id');
				fg_params.styles[ndiv]         = fg_params.divs[ndiv].style;
				fg_params.styles[ndiv].opacity = (fg_params.fragment.begin == 'visible') ? 1.0 : 0.0;
				fg_params.styles[ndiv].clip    = 'rect('  + ( i   *hclip) + 'px,' +
														   ((j+1)*wclip) + 'px,' +
														   ((i+1)*hclip) + 'px,' +
														   ( j   *wclip) + 'px)';
				fg_params.coords[ndiv]    	    = new Coords(rand_between(xmin, xmax),
														     rand_between(ymin, ymax),
														     (Math.random() < 0.5 ? 0 : 4),
															  ndiv / ndivs);
			}
		}
//console.log('fg_params.begin=', fg_params.begin, ', fg_params.state=', ex_params.state, 'fg_params.trans_end=', fg_params.trans_end);					
//console.log(fg_params);
		return;
	}
	
	function format_animate(animate) {
/*
        ==============================================================================================================
        Description
        -----------
        This function is called to modify the "key-frames£ from the user's animation request
        to get them in a format that can be easily manipulated in the "render" function.
        
        Parameters          Description
        ----------          -----------
        animate        The animation object that contains all the info including the key-frames.                           
        ==============================================================================================================
*/
		var 	aprops  = [];
		var     bprops  = [];
		var    anprops  = [];
		var      aval   = {};
		var j           = 0;
		var k           = 0;
		aprops = Object.getOwnPropertyNames(animate).sort();

		for (j=0; j<aprops.length; j++) {
			if ((aprops[j] !='start') && (aprops[j] != 'end') && (aprops[j] != 'ease')) {anprops[k++] = aprops[j];}
		}
		
// process the key-frames animation data
	
		for (j=0; j < anprops.length; j++) {
			aval = animate[anprops[j]];
			bprops = Object.getOwnPropertyNames(aval).sort();
			for (k = 0; k < bprops.length; k++) {
				if (typeof aval[bprops[k]] == 'string') {aval[bprops[k]] = aval[bprops[k]].trim();}
				animate[anprops[j]][bprops[k]] = format_css(aval[bprops[k]]);
			}
		}
	}      // #################### END OF format_animate ####################
	

	function format_css(str){
/*
        ==============================================================================================================
        Description
        -----------
        Yet another function that is called to modify the "key-frames£ from the user's animation request
        to get them in a format that can be easily manipulated in the "render" function.
        
        Parameters          Description
        ----------          -----------
        str        The css property to be animated.                           
        ==============================================================================================================
*/
		var  numRegexp  = /(([+-]{0,1}\d+\.{0,1}\d*)|#([0-9abcdef]+[0-9abcdef]))/ig;
		var hex3Regexp  = /([a-z0-9])([a-z0-9])([a-z0-9])/i;
		var result      = [];
		var atemp       = [];
		var strtemp     = String(str); 
		var j;
		var k      = 0;
		
		if (strtemp === "") {
			result[0] = "";
			return result;
		}
		atemp = strtemp.replace(numRegexp, '|!$1|').split('|');
		for (j=0; j < atemp.length; j++){
			if (atemp[j][0] == '!') {
				if (atemp[j][1] != '#') {
					result[k++] = +atemp[j].substr(1);
				} else {
					if (atemp[j].length == 5) {atemp[j] =atemp[j].replace(hex3Regexp, "$1$1$2$2$3$3");}
					result[k++] = atemp[j].substr(1);
				}
			} else if (atemp[j] !== "") {
				result[k++] = atemp[j];
			}
		}
		return result;
	}      // #################### END OF format_css ####################
	
	function pad(number, length) {  
		var str = '' + number;
		while (str.length < length) {str = '0' + str;}   
		return str;
	}
	
	function error(arr, throw_err){
		var err = 'ERROR: ';
		for (var i = 0; i < arr.length; i++){err += arr[i];}
		console.log(err);
		if (throw_err) {throw(err);} else {
			if (confirm(err + ' DO YOU WISH TO ABORT?')){throw(err);}
		}
	}

	function Left(str, n){
		if (n <= 0)
			return "";
		else if (n > String(str).length)
			return str;
		else
			return String(str).substring(0,n);
	}
	 
	function Right(str, n){
		if (n <= 0)
		   return "";
		else if (n > String(str).length)
		   return str;
		else {
		   var iLen = String(str).length;
		   return String(str).substring(iLen, iLen - n);
		}
	}	
	function get_css_used_val(cstyle, property, htorwd, element) {
		var value = cstyle[property];
		if (Right(value, 2) == 'px') {
			return parseFloat(value);
		}
		if (Right(value, 1) == '%') {
			return parseFloat(value) * 0.01 * (htorwd == 'height' ? element.offsetHeight : element.offsetWidth);
		}
		if ((Right(value, 2) == 'vh') || (Right(value, 2) == 'vw') ){
			return parseFloat(value) * 0.01 * (htorwd == 'height' ? window.innerHeight   : window.innerWidth);
		}
		err = "ERROR: Style value (" + value + ") must be in 'px' or '%' or 'vh'/'vw'";
		console.log(err);
		throw(err);
	}


function run_slideshow(slideshow, ss_params, time, frame_number, frame_rate){
	var slide_no;
	if (ss_params.last_time == time) {return;}
	ss_params.last_time = time;
	
	function all_images_loaded(report){
/*
	Simple test to see if all images are loaded in the DOM. If not:
		Ask user if he/she wants to abort or wait a bit.
		If the "report" argument is true, print a list of missing files to the console-log.
*/
		for (var i = 0; i < ss_params.images.length; i++){
//console.log('EXIF: ' + exif_orientation(ss_params.images[i].getAttributeNode('src').value));
			if (!(ss_params.images[i].complete && (ss_params.images[i].naturalWidth !== 0))) {
				ss_params.images_loaded = false;
				if (report) {console.log('MISSING image: ' + ss_params.images[i].getAttributeNode('src').value);}
			}
		}
		if (!ss_params.images_loaded && report){alert('A list of missing images is on the console-log.');}
		return ss_params.images_loaded;
	}
//	======= End of function all_images_loaded(report) =======

	if (time === 0.0){
		while (!all_images_loaded(false)){
			err = "WARNING: Not all images loaded yet.\n";
			if (!confirm(err + 'DO YOU WANT TO CARRY ON?'           )){if (!all_images_loaded(true)){throw(err);}}
			if (!confirm('DO YOU WANT TO WAIT FOR MISSING IMAGE(s)?')){if (!all_images_loaded(true)){break     ;}}
		}
//console.log('TIME=' + time);
		var parent              = document.querySelectorAll('.webvfx[data-slideshow]')[0];
//console.log(parent);
		ss_params.slide_this    = -1;
		ss_params.slide_prev    = -1;
		ss_params.slide_len     = 1.0 / ss_params.images.length;
		ss_params.trans_len     = ss_params.trans_pcnt * ss_params.slide_len / 100;
		ss_params.parent_cstyle = window.getComputedStyle(parent, null);
		ss_params.parent_width  = parent.getBoundingClientRect().width;
		ss_params.parent_height = parent.getBoundingClientRect().height;
//		ss_params.parent_width  = parent.offsetWidth;
//		ss_params.parent_height = parent.offsetHeight;
		ss_params.parent_ratio  = ss_params.parent_width / ss_params.parent_height;
//console.log('PARENT: width=' + ss_params.parent_width + ', height=' + ss_params.parent_height + ', ratio=' + ss_params.parent_ratio);
//console.log('PARENT: width=' + ss_params.parent_cstyle.width + ', height=' + ss_params.parent_cstyle.height);
		return;
	}
	if (frame_number == 2) {
		ss_params.frame_len    = time;
		ss_params.slide_frames = ss_params.slide_len / ss_params.frame_len;
		ss_params.trans_frames = Math.floor(ss_params.trans_pcnt * ss_params.slide_frames / 100) + 1;
	}
	
	slide_no = Math.floor(time / ss_params.slide_len);	// (first slide is slide_no = 0)
	
	if (slide_no  != ss_params.slide_this ) {	// we have a new slide
		if (ss_params.slide_prev > -1) {
			ss_params.images[ss_params.slide_prev].style.opacity = 0.0;	
		}
		ss_params.slide_prev       = ss_params.slide_this;
		ss_params.slide_this       = slide_no;
		ss_params.slide_start_time = time;
		ss_params.trans_end_time   = time + ss_params.trans_len;
console.log('SLIDE number =' + slide_no);		
		set_image_size();
	}
	
	if (time < ss_params.trans_end_time) {
		transition_image((time-ss_params.slide_start_time)/ss_params.trans_len);
	} else if ((time == ss_params.trans_end_time) && ss_params.type == 'static') {
//console.log('STATIC');
//		ss_params.transition_complete = false;
		transition_image(0.0);
		transition_image(1.0);

//	} else if ((time == ss_params.trans_end_time) || (ss_params.trans_end_time == ss_params.slide_start_time)){
	} else if (time == ss_params.trans_end_time){
		transition_image(1.0);
	} else if (ss_params.slide_len > ss_params.trans_len){
//console.log(1.0 + ss_params.magnify * (time - ss_params.trans_end_time) / (ss_params.slide_len - ss_params.trans_len))
		if (!ss_params.transition_complete) {
			transition_image(1.0);
			ss_params.transition_complete = true;
		}
		transition_image(1.0 + ss_params.magnify * (time - ss_params.trans_end_time) / (ss_params.slide_len - ss_params.trans_len));
	}
	
	function set_image_size() {
		var reverse     = false;
		var this_img    = ss_params.images[ss_params.slide_this];
		var this_p      = this_img.parentElement;
		var exif        = this_img.getAttribute('data-exif');
		var cstyle      = window.getComputedStyle(this_img, null);
		var wadd;
		var hadd;

		if (ss_params.type == 'splitting'){
			if (ss_params.slide_this > 1) {
				ss_params.prev_img_half0.parentNode.removeChild(ss_params.prev_img_half0);
				ss_params.prev_img_half1.parentNode.removeChild(ss_params.prev_img_half1);
			}
			if (ss_params.slide_this !== 0) {
				ss_params.prev_img_half0 = ss_params.this_img_half0;
				ss_params.prev_img_half1 = ss_params.this_img_half1;
			}
			ss_params.this_img_half0 = this_p.appendChild(this_img.cloneNode(true));
			ss_params.this_img_half1 = this_p.appendChild(this_img.cloneNode(true));
		}
		
/*		if  (exif !== null) {
			switch(exif){
				case '180':	orient  = 3;
							break;
				case  '90':	orient  = 6;
							reverse = true;
							break;
				case '-90':	orient  = 8;
							reverse = true;
							break;
				default   :	orient  = 1;
			}
			reverse = false;	// EXIF orientation is not (yet) supported, so switch it off unconditionally
		} */

		wadd =	 get_css_used_val(cstyle, 'border-left-width' , 'width', this_img)
			   + get_css_used_val(cstyle, 'border-right-width', 'width', this_img)
			   + get_css_used_val(cstyle, 'margin-left'       , 'width', this_img)
			   + get_css_used_val(cstyle, 'margin-right'      , 'width', this_img);

		hadd =	 get_css_used_val(cstyle, 'border-top-width'   , 'height', this_img)
			   + get_css_used_val(cstyle, 'border-bottom-width', 'height', this_img)
			   + get_css_used_val(cstyle, 'margin-top'         , 'height', this_img)
			   + get_css_used_val(cstyle, 'margin-bottom'      , 'height', this_img);
			   
//console.log('wadd=' + wadd + ', hadd=' + hadd);
		if (ss_params.slide_this !== 0) {
			ss_params.slide_prev_width         = ss_params.slide_this_width;
			ss_params.slide_prev_height        = ss_params.slide_this_height;
			ss_params.slide_prev_move_distance = ss_params.slide_this_move_distance;
			ss_params.slide_prev_offset        = ss_params.slide_this_offset;
		}
		
		ss_params.slide_this_width  = reverse ? this_img.naturalHeight + wadd : this_img.naturalWidth  + wadd;
		ss_params.slide_this_height = reverse ? this_img.naturalWidth  + hadd : this_img.naturalHeight + hadd;
		ss_params.slide_this_ratio  = ss_params.slide_this_width / ss_params.slide_this_height;
//console.log('SLIDE: width=' + ss_params.slide_this_width + ', height=' + ss_params.slide_this_height + ', ratio=' + ss_params.slide_this_ratio);
		if (ss_params.slide_this_ratio >= ss_params.parent_ratio){
			ss_params.slide_this_width  = ss_params.parent_width - wadd;
			ss_params.slide_this_height = ss_params.slide_this_width / ss_params.slide_this_ratio;
		} else {
			ss_params.slide_this_height = ss_params.parent_height - hadd;
			ss_params.slide_this_width  = ss_params.slide_this_height * ss_params.slide_this_ratio;
		}
//console.log('SLIDE: width=' + ss_params.slide_this_width + ', height=' + ss_params.slide_this_height + ', ratio=' + ss_params.slide_this_ratio);

		this_img.style.height       = (reverse ? ss_params.slide_this_width  : ss_params.slide_this_height) + 'px';
		this_img.style.width        = (reverse ? ss_params.slide_this_height : ss_params.slide_this_width ) + 'px';
		
		ss_params.slide_this_move_distance = (ss_params.horv == 'hriz') ?        ss_params.parent_width +                            2*wadd  :        ss_params.parent_height                              + 2*hadd;
		ss_params.slide_this_offset        = (ss_params.horv == 'hriz') ? 0.5 * (ss_params.parent_width - ss_params.slide_this_width - wadd) : 0.5 * (ss_params.parent_height - ss_params.slide_this_height - hadd);

		if (ss_params.type == 'splitting'){
			ss_params.this_img_half0.style.height = (reverse ? ss_params.slide_this_width  : ss_params.slide_this_height) + 'px';
			ss_params.this_img_half0.style.width  = (reverse ? ss_params.slide_this_height : ss_params.slide_this_width ) + 'px';
			ss_params.this_img_half1.style.height = (reverse ? ss_params.slide_this_width  : ss_params.slide_this_height) + 'px';
			ss_params.this_img_half1.style.width  = (reverse ? ss_params.slide_this_height : ss_params.slide_this_width ) + 'px';
			if (ss_params.horv == 'hriz'){
				ss_params.this_img_half0.style.clip = 'rect(0px,' + (ss_params.slide_this_width+2*wadd)  + 'px,' + (0.5 * ss_params.slide_this_height+hadd) + 'px,0px)';
				ss_params.this_img_half1.style.clip = 'rect(' + (0.5 * ss_params.slide_this_height+hadd) + 'px,' + (ss_params.slide_this_width+2*wadd) + 'px,' + (ss_params.slide_this_height+2*wadd) + 'px,0px)';
			} else {
				ss_params.this_img_half0.style.clip = 'rect(0px,' + (0.5*ss_params.slide_this_width+wadd)  + 'px,' + (ss_params.slide_this_height+2*hadd) + 'px,0px)';
				ss_params.this_img_half1.style.clip = 'rect(0px,' + (ss_params.slide_this_width+2*wadd) + 'px,' + (ss_params.slide_this_height+2*wadd) + 'px,' + (0.5*ss_params.slide_this_width+wadd) + 'px)';
				
			}
		}

		return;
	}

	function transition_image(fraction) {
		var temp;
		var test_scale     = new RegExp(/scale/);
		var p              = (ss_params.slide_prev != -1);
		var this_img       = ss_params.images[ss_params.slide_this];
		var this_p         = this_img.parentElement;
		var cstyle         = window.getComputedStyle(this_img, null);
		var style_this 	   = this_img.style;
		var style_this_half0;
		var style_this_half1;		
		var style_prev;
		var style_prev_half0;
		var style_prev_half1;
		var frease;
		
		if (ss_params.type == 'splitting'){
			style_this_half0 = ss_params.this_img_half0.style;
			style_this_half1 = ss_params.this_img_half1.style;
		}
		if (p) {
			style_prev = ss_params.images[ss_params.slide_prev].style;
			if (ss_params.type == 'splitting'){
				style_prev_half0 = ss_params.prev_img_half0.style;
				style_prev_half1 = ss_params.prev_img_half1.style;
			}
			
		}
//console.log('FRACTION =' + fraction);
//console.log('TRFM A =' + style_this.webkitTransform + ', LEFT=' + style_this.left);
		if (fraction > 1.0) {
			frease = ss_params.easing[ss_params.ease](fraction-1, 1.0, ss_params.magnify, ss_params.magnify);
			if (ss_params.type != 'splitting') {
				if (test_scale.test(style_this.webkitTransform)){
					style_this.webkitTransform = style_this.webkitTransform.replace(/scale.*/, ' scale(' + frease +',' + frease +')');
				} else {
					style_this.webkitTransform = style_this.webkitTransform                  + ' scale(' + frease +',' + frease +')';		
				}
			} else {
				if (test_scale.test(style_this_half0.webkitTransform)){
					style_this.webkitTransform       = style_this.webkitTransform.replace(/scale.*/,       ' scale(' + frease +',' + frease +')');
					style_this_half0.webkitTransform = style_this_half0.webkitTransform.replace(/scale.*/, ' scale(' + frease +',' + frease +')');
					style_this_half1.webkitTransform = style_this_half1.webkitTransform.replace(/scale.*/, ' scale(' + frease +',' + frease +')');
				} else {
					style_this.webkitTransform       = style_this.webkitTransform                        + ' scale(' + frease +',' + frease +')';		
					style_this_half0.webkitTransform = style_this_half0.webkitTransform                  + ' scale(' + frease +',' + frease +')';		
					style_this_half1.webkitTransform = style_this_half1.webkitTransform                  + ' scale(' + frease +',' + frease +')';					
				}
			}
//console.log('TRFM B =' + style_this.webkitTransform + ', LEFT=' + style_this.left);
			return;
		}
		
		if (fraction === 0) {
//console.log('Fraction = 0, Left=' + cstyle['left']);
//console.log(this_p);
			style_this.display = "block";
			ss_params.transition_complete = false;
			style_this.opacity = (ss_params.type == 'static');
			x = get_css_used_val(cstyle, 'left', 'width', this_p);
//console.log('left =' + style_this.left + ' + top =' + style_this.top + ' + property left =' + x);
			if ((ss_params.type == 'appearing') || (ss_params.type == 'expanding') || (ss_params.type == 'stretching') || (ss_params.type == 'static')){
				style_this.left = ss_params.slide_this_offset + 'px';
				style_this.top  = get_css_used_val(cstyle, 'top'       , 'height', this_p) -
								 get_css_used_val(cstyle, 'margin-top', 'height', this_img) + 'px';
			} else if (ss_params.type == 'splitting'){
				style_this.visibility    = "hidden";
				style_this_half0.display = "block";
				style_this_half1.display = "block";
				if (p) {
					style_prev.visibility       = 'hidden';
					style_prev_half0.visibility = 'visible';
					style_prev_half1.visibility = 'visible';
				}
//				style_this_half0.opacity = (ss_params.type == 'static');
//				style_this_half0.opacity = (ss_params.type == 'static');

				style_this.left = get_css_used_val(cstyle, 'left'       , 'width', this_p) -
								 get_css_used_val(cstyle, 'margin-left', 'width', this_img) + 'px';
				style_this.top  = get_css_used_val(cstyle, 'top'       , 'height', this_p) -
								 get_css_used_val(cstyle, 'margin-top', 'height', this_img) + 'px';
//co			style_this_half0.left = style_this.left;
				style_this_half1.left = style_this.left;
				style_this_half0.top  = style_this.top;
				style_this_half1.top  = style_this.top;
			} else {
				style_this.left = get_css_used_val(cstyle, 'left'       , 'width', this_p) -
								 get_css_used_val(cstyle, 'margin-left', 'width', this_img) + 'px';
				style_this.top  = get_css_used_val(cstyle, 'top'       , 'height', this_p) -
								 get_css_used_val(cstyle, 'margin-top', 'height', this_img) + 'px';
//console.log(ss_params.slide_this_move_distance);

			}
			if (ss_params.type == 'expanding') {
				style_this.webkitTransform += 'scale(0,0)';
			}
			if (ss_params.type == 'stretching') {
//				style_this.webkitTransformOrigin = 'center top';
				style_this.webkitTransform += ((ss_params.ofrom == 'top') || (ss_params.ofrom == 'bottom')) ? 'rotateX(90deg)' : 'rotateY(90deg)';
			}
			
//console.log('left =' + style_this.left + ' + top =' + style_this.top + ' + property left =' + cstyle['left']);
			
		}
		if ((ss_params.type == 'sliding') || (ss_params.type == 'shuffling')) {
			if (!ss_params.transition_complete) {
				frease = ss_params.easing[ss_params.ease](fraction, 0.0, 1.0, 1.0);
				style_this.opacity = frease;
				if (ss_params.blur !== 0) {style_this.webkitFilter = 'blur(' + (1.0 - frease) * ss_params.blur + 'px)';}
				style_this[ss_params.dirn]  = ( ss_params.sign * (1-frease) * ss_params.slide_this_move_distance + ss_params.slide_this_offset) + 'px';
				if (p) {
					style_prev.opacity = 1.0 - frease;
					if (ss_params.blur !== 0) {style_prev.webkitFilter = 'blur(' + frease * ss_params.blur + 'px)';}

					if (ss_params.type == 'sliding') {
						style_prev[ss_params.dirn]  = (-ss_params.sign *    frease  * ss_params.slide_prev_move_distance + ss_params.slide_prev_offset) + 'px';
					} else if (ss_params.type == 'shuffing') {
						style_prev[ss_params.dirn]  = ( ss_params.sign *    frease  * ss_params.slide_prev_move_distance + ss_params.slide_prev_offset) + 'px';
					}
				}
				ss_params.transition_complete = (fraction == 1.0);
	
				if (p && ss_params.transition_complete){
					style_prev.display = "none";	
				}
			}
		} else if (ss_params.type == 'splitting'){
			if (!ss_params.transition_complete) {
				frease = ss_params.easing[ss_params.ease](fraction, 0.0, 1.0, 1.0);
				style_this.opacity       = frease;
				style_this_half0.opacity = frease;
				style_this_half1.opacity = frease;
				if (ss_params.blur !== 0) {
					style_this.webkitFilter       = 'blur(' + (1.0 - frease) * ss_params.blur + 'px)';
					style_this_half0.webkitFilter = 'blur(' + (1.0 - frease) * ss_params.blur + 'px)';
					style_this_half1.webkitFilter = 'blur(' + (1.0 - frease) * ss_params.blur + 'px)';
					}
				style_this[ss_params.dirn]        = (-ss_params.sign * (1-frease) * ss_params.slide_this_move_distance + ss_params.slide_this_offset) + 'px';
				style_this_half0[ss_params.dirn]  = (-ss_params.sign * (1-frease) * ss_params.slide_this_move_distance + ss_params.slide_this_offset) + 'px';
				style_this_half1[ss_params.dirn]  = ( ss_params.sign * (1-frease) * ss_params.slide_this_move_distance + ss_params.slide_this_offset) + 'px';
				if (p) {
					style_prev.opacity       = 1.0 - frease;
					style_prev_half0.opacity = 1.0 - frease;
					style_prev_half1.opacity = 1.0 - frease;
					if (ss_params.blur !== 0) {
						style_prev.webkitFilter       = 'blur(' + frease * ss_params.blur + 'px)';
						style_prev_half0.webkitFilter = 'blur(' + frease * ss_params.blur + 'px)';
						style_prev_half1.webkitFilter = 'blur(' + frease * ss_params.blur + 'px)';
					}
					style_prev[ss_params.dirn]        = (-ss_params.sign *    frease  * ss_params.slide_prev_move_distance + ss_params.slide_prev_offset) + 'px';
					style_prev_half0[ss_params.dirn]  = (-ss_params.sign *    frease  * ss_params.slide_prev_move_distance + ss_params.slide_prev_offset) + 'px';
					style_prev_half1[ss_params.dirn]  = ( ss_params.sign *    frease  * ss_params.slide_prev_move_distance + ss_params.slide_prev_offset) + 'px';
				}
				ss_params.transition_complete = (fraction == 1.0);

				if (ss_params.transition_complete){
					style_this.visibility       = "visible";
					style_this_half0.visibility = "hidden";	
					style_this_half1.visibility = "hidden";	
				}
			}
		} else if (ss_params.type == 'static') {
				style_this.opacity = 1.0;
				if (p) {
					style_prev.opacity = 0.0;
				}
				ss_params.transition_complete = true;
	
				if (p && ss_params.transition_complete){
					style_prev.display = "none";	
				}
		} else if (ss_params.type == 'appearing') {
			if (!ss_params.transition_complete) {
				frease = ss_params.easing[ss_params.ease](fraction, 0.0, 1.0, 1.0);
				style_this.opacity = frease;
				if (ss_params.blur !== 0) {style_this.webkitFilter = 'blur(' + (1.0 - frease) * ss_params.blur + 'px)';}
				if (p) {
					style_prev.opacity = 1.0 - frease;
					if (ss_params.blur !== 0) {style_prev.webkitFilter = 'blur(' + frease * ss_params.blur + 'px)';}
				}
				ss_params.transition_complete = (fraction == 1.0);
	
				if (p && ss_params.transition_complete){
					style_prev.display = "none";	
				}
			}
		}  else if (ss_params.type == 'expanding') {
			if (!ss_params.transition_complete) {
				frease = ss_params.easing[ss_params.ease](fraction, 0.0, 1.0, 1.0);
				style_this.opacity = frease;
				temp = 'scale(' + frease +',' + frease +')';
				style_this.webkitTransform = style_this.webkitTransform.replace(/scale\(\d+.{0,1}\d*,\s*\d+.{0,1}\d*\)/, temp);
				if (ss_params.blur !== 0) {style_this.webkitFilter = 'blur(' + (1.0 - frease) * ss_params.blur + 'px)';}
				if (p) {
					style_prev.opacity = 1.0 - frease;
					temp = 'scale(' + (1.0 - frease) +',' + (1.0 - frease) +')';
					style_prev.webkitTransform = style_prev.webkitTransform.replace(/scale\(\d+.{0,1}\d*,\s*\d+.{0,1}\d*\)/, temp);
					if (ss_params.blur !== 0) {style_prev.webkitFilter = 'blur(' + frease * ss_params.blur + 'px)';}
				}
				ss_params.transition_complete = (fraction == 1.0);
	
				if (p && ss_params.transition_complete){
					style_prev.display = "none";	
				}
			}
		}  else if (ss_params.type == 'stretching') {
			if (!ss_params.transition_complete) {
				frease = ss_params.easing[ss_params.ease](fraction, 0.0, 1.0, 1.0);
				style_this.opacity = frease;
				temp = ((ss_params.ofrom == 'top') || ((ss_params.ofrom == 'bottom')) ? 'rotateX(' : 'rotateY(') + (1.0 - frease) * 90.0 +'deg)';
				style_this.webkitTransform = style_this.webkitTransform.replace(/rotate[XY].*deg\)/, temp);
				if (ss_params.blur !== 0) {style_this.webkitFilter = 'blur(' + (1.0 - frease) * ss_params.blur + 'px)';}
				if (p) {
					style_prev.opacity = 1.0 - frease;
					temp = ((ss_params.ofrom == 'top') || ((ss_params.ofrom == 'bottom')) ? 'rotateX(' : 'rotateY(') + frease * 90.0 +'deg)';
					style_prev.webkitTransform = style_this.webkitTransform.replace(/rotate[XY].*deg\)/, temp);
					if (ss_params.blur !== 0) {style_prev.webkitFilter = 'blur(' + frease * ss_params.blur + 'px)';}
				}
				ss_params.transition_complete = (fraction == 1.0);
	
				if (p && ss_params.transition_complete){
					style_prev.display = "none";	
				}
			}
		}
		return;
	}
}

	function run_explosion(explosion, ex_params, time, frame_number, frame_rate) {

		var t = time;
		var toffset;
        var nkeyframes = 0;
		var i = 0;
		var duration;
		var start;
		var end;
		var  prop;
		var sprop;
		var  prop_next;
		var sprop_next;
		
		var aprops = [];
	
//console.log('time=', t, '.ex_params=', ex_params, ', Elusien=', Elusien);		
		if (time === 0.0) {
			ex_params.last_time  = -1;
			ex_params.frame_len  = 1000.0 / frame_rate;		// Length of a frame in msecs.
			ex_params.state      = 'imploded';
		}
				
		if (ex_params.last_time == time) {return -1;} // This frame is the same as the last one!
		
		ex_params.last_time  = time;
		start      = +ex_params.explode.start;
		end        = +ex_params.explode.end;
		duration   = end - start;
		aprops     = Object.getOwnPropertyNames(ex_params.explode).sort();
//console.log('DEBUG: t=', t, ', aprops.length=' + aprops.length + ', aprops[0]=' + aprops[0]+ ', transend=' + ex_params.trans_end);				
		if ((t >= start) && (t <= end)) {
			
// The next statement is to get over the problem that the time never reaches 1.0. the last time is for the last frame
// which can appear up to 1/frame-rate seconds before 1.0. Since we do not know the framerate, assume it is 24fps.

			if ((end-t) < 2*Elusien.frame_length){t = end;}
			if ((aprops.length > 0) && (aprops[0].match(/^\d+(.\d)*$/) !== null)){ // We have a keyframe e.g. 080, first is 000
				nkeyframes++;
				sprop    =  aprops[0];	// As a string e.g. '080'
				 prop    = +sprop;		// As a number e.g. 80
//console.log('t=', t, ', check=', (prop * duration / 100) + start);
				if (((prop * duration / 100) + start) <= t) { // the current time is >= the keyframe, so this keyframe is now active
//console.log('DEBUG: t=' + t + ', aprops[0]=' + aprops[0] + ', val=' + ex_params.explode[sprop] + ', FROM=', (+start + (prop * duration / 100)));
					if (prop == 100) {
						switch (ex_params.state) {
							case 'imploded':
								for (i = 0; i < ex_params.spans.length ; i++) {
									ex_params.styles[i].opacity = (ex_params.explode.finish == 'visible') ? 1.0 : 0.0;
								}
								break;
							case 'exploded':		
								break;
							case 'exploding':		// Set characters to 'exploded' state.
								for (i = 0; i < ex_params.spans.length ; i++) {
									ex_params.styles[i].webkitTransform = 'translate(' +
										ex_params.coords[i].x + 'px , ' + ex_params.coords[i].y + 'px) scale(1.0, 1.0)'								
									;
									ex_params.styles[i].opacity = 0.0;
								}
								ex_params.state = 'exploded';
								break;
							case 'imploding':		// Set characters to 'imploded' state.
								for (i = 0; i < ex_params.spans.length ; i++) {
									ex_params.styles[i].webkitTransform = 'translate(0px , 0px) scale(1.0, 1.0)';
									ex_params.styles[i].opacity         = (ex_params.explode.finish == 'visible') ? 1.0 : 0.0;
								}
								ex_params.state = 'imploded';
								break;
						}
						return;
					}
					sprop_next            = aprops[1];
					 prop_next            = +sprop_next;
					trans_duration        = (prop_next - prop) / 100;
					ex_params.trans_start = t;					// Normalised time at the start of the transition
					ex_params.trans_end   = t + (duration * (prop_next - prop) / 100);
					ex_params.trans_durn  = ex_params.trans_end - ex_params.trans_start;
					ex_params.transition  = ex_params.explode[sprop];
//console.log('ex_params.transition=', ex_params.transition, ', ex_params.state=', ex_params.state, 'ex_params.trans_end=', ex_params.trans_end);					
					switch (ex_params.transition) {
						case 'wait':
							switch (ex_params.state) {
								case 'imploded':
								case 'exploded':		
									break;
								case 'exploding':		// Set characters to 'exploded' state.
									for (i = 0; i < ex_params.spans.length ; i++) {
										ex_params.styles[i].webkitTransform = 'translate(' +
											ex_params.coords[i].x + 'px , ' + ex_params.coords[i].y + 'px) scale(1.0, 1.0)'								
										;
										ex_params.styles[i].opacity = 0.0;
									}
									ex_params.state = 'exploded';
									break;
								case 'imploding':		// Set characters to 'imploded' state.
									for (i = 0; i < ex_params.spans.length ; i++) {
										ex_params.styles[i].webkitTransform = 'translate(0px , 0px) scale(1.0, 1.0)';
										ex_params.styles[i].opacity         = 1.0;
									}
									ex_params.state = 'imploded';
									break;
							}
							break;
						case 'explode':
							switch (ex_params.state) {
								case 'imploded':
									break;
								case 'exploded':		
								case 'imploding':
								case 'exploding':	// Set characters to 'imploded' state, so they can be exploded.
									for (i = 0; i < ex_params.spans.length ; i++) {
										ex_params.styles[i].webkitTransform = 'translate(0px , 0px) scale(1.0, 1.0)';
										ex_params.styles[i].opacity         = 1.0;
									}
									ex_params.state = 'imploded';
									break;
							}
							break;
						case 'implode':
							switch (ex_params.state) {
								case 'exploded':
									break;
								case 'imploded':
								case 'imploding':
								case 'exploding':	// set characters to 'exploded' state, so they can be imploded.
									for (i = 0; i < ex_params.spans.length ; i++) {
										ex_params.styles[i].webkitTransform = 'translate(' +
											ex_params.coords[i].x + 'px , ' + ex_params.coords[i].y + 'px) scale(1.0, 1.0)'								
										;
										ex_params.styles[i].opacity = 0.0;
									}
									ex_params.state = 'exploded';
									break;
							}
							break;
						default:
							err = 'Illegal value for keyframe ' + sprop + ':' + ex_params.transition;
							console.log(err);
							alert(err);
							throw(err);
					}
					delete ex_params.explode[sprop];	// Now the keyframe is active delete it from the object.
				}
			}

			switch (ex_params.transition) {
				case 'wait':		// Do nothing, the spans are static, they do not animate.
					return;
				case 'explode':		// Explode each span by 1 increment, time-offset each span by a small amount.
					for (i = 0; i < ex_params.spans.length ; i++) {
						if ((t-ex_params.trans_start) >+ 0.5 * ex_params.coords[i].d * ex_params.trans_durn) {
							toffset = t-ex_params.trans_start - 0.5 * ex_params.coords[i].d * ex_params.trans_durn;
							doffset = ex_params.trans_durn    - 0.5 * ex_params.coords[i].d * ex_params.trans_durn;
							ex_params.styles[i].webkitTransform = 'translate(' +
								ex_params.explode.easing[ex_params.explode.ease](toffset,0,ex_params.coords[i].x  ,doffset)	+ 'px , ' +
								ex_params.explode.easing[ex_params.explode.ease](toffset,0,ex_params.coords[i].y  ,doffset) + 'px) scale(' +
								ex_params.explode.easing[ex_params.explode.ease](toffset,1,ex_params.coords[i].z-1,doffset) + ' , ' +
								ex_params.explode.easing[ex_params.explode.ease](toffset,1,ex_params.coords[i].z-1,doffset) + ')'
							;
							ex_params.styles[i].opacity = ex_params.explode.easing[ex_params.explode.ease](toffset,1,-1,doffset);
						}
					}
					ex_params.state = (t != 1 ? 'exploding' : 'exploded'); 
					return;
				case 'implode':		// Implode each span by 1 increment.
					for (i = 0; i < ex_params.spans.length ; i++) {
//						if ((t-ex_params.trans_start) <= ex_params.trans_durn - 0.5 * ex_params.coords[i].d * ex_params.trans_durn) { DO NOT UNCOMMENT
						if ((t-ex_params.trans_start) <= ex_params.trans_durn) {
							toffset = t-ex_params.trans_start;
							doffset = ex_params.trans_durn; //    - 0.5 * ex_params.coords[i].d * ex_params.trans_durn; DO NOT UNCOMMENT - not a good effect
//if  (i === 0) {console.log('implode: ex_params.state=',ex_params.state, ', toffset=', toffset, ', doffset=', doffset);}
							ex_params.styles[i].webkitTransform = 'translate(' +
								ex_params.explode.easing[ex_params.explode.ease](toffset,ex_params.coords[i].x, -ex_params.coords[i].x,doffset)	+ 'px , ' +
								ex_params.explode.easing[ex_params.explode.ease](toffset,ex_params.coords[i].y, -ex_params.coords[i].y,doffset) + 'px) scale(' +
								ex_params.explode.easing[ex_params.explode.ease](toffset,ex_params.coords[i].z,1-ex_params.coords[i].z,doffset) + ' , ' +
								ex_params.explode.easing[ex_params.explode.ease](toffset,ex_params.coords[i].z,1-ex_params.coords[i].z,doffset) + ')'
							;
							ex_params.styles[i].opacity = ex_params.explode.easing[ex_params.explode.ease](toffset,0,1,doffset);
						}
					}
					ex_params.state = (t != 1 ? 'imploding' : 'imploded'); 
					return;				
			}
							
		}
	}      // #################### END OF run_explosion ####################

	const ANIMS = [
		[{pcnt:	  0, norm: 0   , opacity: 0   , translate: [-150,  -50], rotate: -180, scale: 3   , color: ''},
		 {pcnt:	 60, norm: 0.6 , opacity: 0.6 , translate: [  20,   20], rotate:   30, scale: 0.3 , color: ''},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''}
		],
		[{pcnt:	  0, norm: 0   , opacity: 0   , translate: [ 200, -100], rotate:    0, scale: 2   , color: ''},
		 {pcnt:	 60, norm: 0.6 , opacity: 0.6 , translate: [   0,   20], rotate: -180, scale: 0.5 , color: ''},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''}
		],
		[{pcnt:	  0, norm: 0   , opacity: 0   , translate: [-300,    0], rotate:    0, scale: 0   , color: ''},
		 {pcnt:	 60, norm: 0.6 , opacity: 0.6 , translate: [  20,    0], rotate:    0, scale: 1   , color: ''},
		 {pcnt:	 80, norm: 0.8 , opacity: 0.8 , translate: [  20,    0], rotate:    0, scale: 1   , color: ''},
		 {pcnt:	 95, norm: 0.95, opacity: 0.95, translate: [   0,    0], rotate:    0, scale: 1.5 , color: '#0ff'},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''}
		],
		[{pcnt:	  0, norm: 0   , opacity: 0   , translate: [   0, -100], rotate:  360, scale: 1   , color: ''},
		 {pcnt:	 30, norm: 0.3 , opacity: 0.3 , translate: [   0,  -50], rotate:  180, scale: 1   , color: ''},
		 {pcnt:	 60, norm: 0.6 , opacity: 0.6 , translate: [   0,   20], rotate:    0, scale: 0.8 , color: ''},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''}
		],
		[{pcnt:	  0, norm: 0   , opacity: 0   , translate: [   0, -100], rotate:  360, scale: 0   , color: ''},
		 {pcnt:	 30, norm: 0.3 , opacity: 0.3 , translate: [   0,  -50], rotate:  180, scale: 1   , color: ''},
		 {pcnt:	 50, norm: 0.5 , opacity: 1   , translate: [   0,   20], rotate:    0, scale: 0.8 , color: ''},
		 {pcnt:	 80, norm: 0.6 , opacity: 0   , translate: [-100, -100], rotate: -180, scale: 1.5 , color: ''},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''}
		],
		[{pcnt:	  0, norm: 0   , opacity: 0   , translate: [ 150,    0], rotate: -180, scale: 1   , color: ''    , order: 'rt'},
		 {pcnt:	 10, norm: 0.1 , opacity: 1   , translate: [ 135,    0], rotate: -162, scale: 1   , color: ''    , order: 'rt'},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''    , order: 'rt'}
		],
		[{pcnt:	  0, norm: 0   , opacity: 0   , translate: [-150,    0], rotate:    0, scale: 0.3 , color: ''},
		 {pcnt:	 40, norm: 0.4 , opacity: 1   , translate: [  50,    0], rotate:    0, scale: 0.7 , color: ''},
		 {pcnt:	 60, norm: 0.6 , opacity: 0.5 , translate: [  25,    0], rotate:    0, scale: 1.35, color: '#14b'},
		 {pcnt:	 80, norm: 0.8 , opacity: 0   , translate: [   0,    0], rotate:    0, scale: 2   , color: '#780'},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''}
		],
		[{pcnt:	  0, norm: 0   , opacity: 0   , translate: [-150,  -50], rotate: -180, scale: 3   , color: ''},
		 {pcnt:	 60, norm: 0.6 , opacity: 0.6 , translate: [  20,   20], rotate:   30, scale: 0.3 , color: ''},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''}
		],
		[{pcnt:	  0, norm: 0   , opacity: 0   , translate: [   0,    0], rotate: -360, scale: 0   , color: ''   , order: 'rt'},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'}
		],
		[{pcnt:	  0, norm: 0   , opacity: 1   , translate: [   0,  -50], rotate:    0, scale: 0   , color: ''   , order: 'rt'},
		 {pcnt:	 40, norm: 0.4 , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'},
		 {pcnt:	 70, norm: 0.7 , opacity: 1   , translate: [   0,  -20], rotate:    0, scale: 1   , color: ''   , order: 'rt'},
		 {pcnt:	 90, norm: 0.7 , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'},
		 {pcnt:	 95, norm: 0.95, opacity: 1   , translate: [   0,   -7], rotate:    0, scale: 1   , color: ''   , order: 'rt'},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'}
		],
		[{pcnt:	  0, norm: 0   , opacity: 1   , translate: [-150,    0], rotate:    0, scale: 0   , color: ''   , order: 'rt'},
		 {pcnt:	 40, norm: 0.4 , opacity: 1   , translate: [  90,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'},
		 {pcnt:	 70, norm: 0.7 , opacity: 1   , translate: [ -50,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'},
		 {pcnt:	 90, norm: 0.7 , opacity: 1   , translate: [  15,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'},
		 {pcnt:	 95, norm: 0.95, opacity: 1   , translate: [  -7,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'}
		],
		[{pcnt:	  0, norm: 0   , opacity: 1   , translate: [ 150,   50], rotate: -180, scale: 0   , color: ''   , order: 'rt'},
		 {pcnt:	 95, norm: 0.95, opacity: 1   , translate: [   0,    0], rotate: -180, scale: 1   , color: ''   , order: 'rt'},
		 {pcnt:	100, norm: 1   , opacity: 1   , translate: [   0,    0], rotate:    0, scale: 1   , color: ''   , order: 'rt'}
		]
	];
	
	function animps(a) {
		var r = [];
		for (var i = 0; i < a.length; i++) {
			r.push({
						p: a[i].pcnt,
						n: a[i].norm,
						o: a[i].opacity,
						x: a[i].translate[0],
						y: a[i].translate[1],
						r: a[i].rotate,
						s: a[i].scale,
						c: a[i].color,
				order: a[i].order
			});
		}
		return r;
	}
	
	
	function run_rolling(rolling, rl_params, time, frame_number, frame_rate) {

		var t            = time;
		var rlp          = rl_params;	// For convenience of coding.
		var rlp_spandata;
		var nanims  = ANIMS[rlp.roll.type].length;
		var nspans  = rlp.spans.length;
			
		if (t === 0.0) {	// Initialise certain rlp properties.
			rlp.last_time    = -1;
			rlp.frame_len    = 1000.0 / frame_rate;		// Length of a frame in msecs.
			rlp.start        = +rlp.roll.start;
			rlp.end          = +rlp.roll.end;
			rlp.duration     = rlp.end - rlp.start;
			rlp.state        = 'flowed';
			rlp.text_flow = animps(ANIMS[rlp.roll.type]);
			
			var aprops    = Object.keys(rlp.roll).sort();
			rlp.keyframes = [];
//			rlp.keyframes.push({prop: -099, n: -0.99, val: 'INITIALISE'}); //  000: flow, 050: wait,  100: wait

			for (var i = 0; i < aprops.length; i++) {
				if (aprops[i].match(/^\d+(.\d)*$/) !== null) { // This property is a keygrame.
					rlp.keyframes.push({prop: aprops[i], n: 0.01 * aprops[i], val: rlp.roll[aprops[i]]}); //  000: flow, 050: wait,  100: wait
				}
			}
console.log(rlp.keyframes);
			for (i = rlp.keyframes.length - 1; i>= 0; i--) {
				rlp.keyframes[i].stt = rlp.start + rlp.keyframes[i].n * rlp.duration;	// Start time
				rlp.keyframes[i].dur = (i == rlp.keyframes.length - 1) ? 0 : (rlp.keyframes[i+1].stt - rlp.keyframes[i].stt);	// Duration
				rlp.keyframes[i].end = rlp.keyframes[i].stt + rlp.keyframes[i].dur;		// End time
			}
			
			rlp.kfn        = -1;	// Keyframe number.
			rlp.transition = rlp.keyframes[0].val;// e.g. flow
			rlp.nkframes   = 0;

			rlp.spandata = [];
			for (i = 0; i < nspans ; i++) {
				rlp.spandata[i] = {finalised: false, delay: i/nspans, kfn: 0,
													 color: window.getComputedStyle(rlp.spans[i], null).getPropertyValue("color")};
				rlp.styles[i].opacity = (rlp.roll.begin == 'visible') ? 1.0 : 0.0;
			}

console.log('time=', t, ', rlp=', rlp, ', Elusien=', Elusien);	
		}

		var text_flow  = rlp.text_flow;	// For convenience of coding;
    rlp_spandata = rlp.spandata;		
				
		if (rlp.last_time == time) {return -1;} // This frame is the same as the last one - not sure if this can happen!
		
		rlp.last_time = time;
		
		if ((t >= rlp.start) && (t <= rlp.end)) {  // Usually start=0.0 and end=1.0
			
// The next statement is to get over the problem that the time never reaches 1.0. the last time is for the last frame
// which can appear up to 1/frame-rate seconds before 1.0.

			if ((rlp.end-t) < 2*Elusien.frame_length){t = rlp.end;}

			var keyframes = rlp.keyframes;	// For convenience of coding.
			if ((rlp.nkframes == 0) || (t > rlp.keyframes[rlp.kfn].end)) {	// we have just moved onto the next keyframe e.g flow to wait
				rlp.nkframes++;
				rlp.kfn++;
				rlp.transition = keyframes[rlp.kfn].val;
console.log('t=', t, ', New Keyframe number=', rlp.kfn, ', keyframes=', keyframes);
			
				if (keyframes.n == 1) {	// 100%
					switch (rlp.state) {
						case 'rolled':
							rolling.innerHTML = rlp.originalHTML;
							rolling.opacity = (rlp.roll.finish == 'visible') ? 1.0 : 0.0;
							break;
						case 'flowing':		// Set characters to 'imploded' state.
							rlp.state = 'flowed';
							rolling.innerHTML = rlp.originalHTML;
							rolling.opacity = (rlp.roll.finish == 'visible') ? 1.0 : 0.0;
							break;
					}
					return;
				} else {	// Just moved into a new keyframe that is not the last one.
console.log(rlp.kfn, keyframes);
console.log(keyframes[rlp.kfn]);
					rlp.transition = keyframes[rlp.kfn].val;
					switch (rlp.transition) {
						case 'wait':
							break;
						case 'flow':
							rlp.state = 'rolled';
							break;
						default:
							err = 'Illegal value for keyframe ' + keyframes[rlp.kfn].prop + ':' + rlp.transition;
							console.log(err);
							alert(err);
							throw(err);
					}
					if (rlp.transition == 'wait') {
							rolling.innerHTML = rlp.originalHTML;
							rolling.opacity = (rlp.roll.finish == 'visible') ? 1.0 : 0.0;
					} else {
console.log(nanims, rlp.kfn, keyframes, text_flow, rlp.transition);
						for (var it = nanims - 1; it>= 0; it--){
							text_flow[it].stt = keyframes[rlp.kfn].stt + text_flow[it].n * 0.5 * keyframes[rlp.kfn].dur;	// Start time
							text_flow[it].dur = (it == nanims - 1) ? 0 :  text_flow[it+1].stt - text_flow[it].stt;	// Duration
							text_flow[it].end = text_flow[it].stt + text_flow[it].dur;	// End time
						}
						for (var ip = 0; ip <nspans; ip++) {
							rlp_spandata[ip].kfn = 0;
							rlp_spandata[ip].stt = text_flow[0].stt + rlp_spandata[ip].delay * (0.5 * keyframes[rlp.kfn].dur);
							rlp_spandata[ip].end =                    rlp_spandata[ip].stt + text_flow[rlp_spandata[ip].kfn].dur;
						}
					}
				}
			}
				
//console.log(rlp);			
			for (var m=0; m<nspans; m++) {

//console.log('rlp.transition=', rlp.transition, ', rlp.state=', rlp.state, 'rlp.trans_end=', rlp.trans_end);					

				switch (rlp.transition) {
					case 'wait':		// Do nothing, the spans are static, they do not animate.
						return;
					case 'flow':	// Flow each span by 1 increment, time-offset each span by a small amount..
						for (var s = 0; s < nspans ; s++) {
							if ((t >=  rlp_spandata[s].end)  && (rlp_spandata[s].kfn != nanims-1)) {
								rlp_spandata[s].kfn++;
								rlp_spandata[s].stt  = rlp_spandata[s].end;
								rlp_spandata[s].end  = rlp_spandata[s].stt + text_flow[rlp_spandata[s].kfn].dur;
							}
							var spd      = rlp_spandata[s];
							var kfn      = spd.kfn;
							var span_stt = spd.stt;
							var span_end = spd.end;
							var tkfn     = text_flow[kfn];
							var tkfnp1   = text_flow[kfn+1];
							var easing   = rlp.roll.easing[rlp.roll.ease];
if (s === 0) console.log('DEBUG: t=', t, ', span_stt=', span_stt, ', span_end=', span_end, ', spd=', spd);							
							if ((t >= span_stt) && (kfn != nanims-1)) {
								rlp.styles[s].webkitTransform = tkfn.order == 'rt' ? (
														  'rotate('  	 + easing(t-span_stt, tkfn.r, tkfnp1.r - tkfn.r, span_end - span_stt) + 'deg) '
														+	'translate(' + easing(t-span_stt, tkfn.x, tkfnp1.x - tkfn.x, span_end - span_stt) + 'px ' 
														+ ', '				 + easing(t-span_stt, tkfn.y, tkfnp1.y - tkfn.y, span_end - span_stt) + 'px) '
														+ 'scale('		 + easing(t-span_stt, tkfn.s, tkfnp1.s - tkfn.s, span_end - span_stt) + ')'
																																) : (
															'translate(' + easing(t-span_stt, tkfn.x, tkfnp1.x - tkfn.x, span_end - span_stt) + 'px ' 
														+ ', '				 + easing(t-span_stt, tkfn.y, tkfnp1.y - tkfn.y, span_end - span_stt) + 'px) '
														+ 'rotate('  	 + easing(t-span_stt, tkfn.r, tkfnp1.r - tkfn.r, span_end - span_stt) + 'deg) '
														+ 'scale('		 + easing(t-span_stt, tkfn.s, tkfnp1.s - tkfn.s, span_end - span_stt) + ')'
																																) ;
								rlp.styles[s].opacity 				= easing(t-span_stt, tkfn.o, tkfnp1.o - tkfn.o, span_end - span_stt);
								rlp.styles[s].color           = (tkfn.c != '') ? tkfn.c : spd.color;
if (s === 0) console.log('DEBUG: t=', t, text_flow[kfn], ', tkfn.c=', tkfn.c, ', webkitTransform=', rlp.styles[s].webkitTransform);
							} else if ((t >= span_stt) && ! spd.finalised) {
								spd.finalised = (kfn == nanims - 1);
								rlp.styles[s].webkitTransform = text_flow[nanims-1].order == 'rt' ? (
														  'rotate('  	 + text_flow[nanims-1].r + 'deg)'
														+ 'translate(' + text_flow[nanims-1].x + 'px'
														+ ', '				 + text_flow[nanims-1].y + 'px) '
														+ ' scale(' 	 + text_flow[nanims-1].s + ') '
																																							) : (
														  'translate(' + text_flow[nanims-1].x + 'px'
														+ ', '				 + text_flow[nanims-1].y + 'px) '
														+ 'rotate('  	 + text_flow[nanims-1].r + 'deg)'
														+ ' scale(' 	 + text_flow[nanims-1].s + ') '
																																							)	;
								rlp.styles[s].opacity 				=  text_flow[nanims-1].o;					
								rlp.styles[s].color           = (text_flow[nanims-1].c != '') ? text_flow[nanims-1].c : spd.color;
							}
						}
						if (t !== 1) {
							rlp.state = 'flowing';
							return;
						}
						rlp.state = 'flowed';
						rolling.innerHTML = rlp.originalHTML;
						return;

					default:
							err = 'BAD value [rlp.transition=' + rlp.transition + ']';
							console.log(err);
							alert(err);
							throw(err);
				}
			}
		}
	}      // #################### END OF run_rolling ####################


	function run_fragment(fragment, fg_params, time, frame_number, frame_rate) {

		var t = time;
		var toffset;
        var nkeyframes = 0;
		var i = 0;
		var duration;
		var start;
		var end;
		var  prop;
		var sprop;
		var  prop_next;
		var sprop_next;
		
		var aprops = [];
	
//console.log('time=', t, '.fg_params=', fg_params, ', Elusien=', Elusien);		
		if (time === 0.0) {
			fg_params.last_time  = -1;
			fg_params.frame_len  = 1000.0 / frame_rate;		// Length of a frame in msecs.
			fg_params.state      = 'defragmented';
		}
				
		if (fg_params.last_time == time) {return -1;} // This frame is the same as the last one!
		
		fg_params.last_time  = time;
		start      = +fg_params.fragment.start;
		end        = +fg_params.fragment.end;
		duration   = end - start;
		aprops     = Object.getOwnPropertyNames(fg_params.fragment).sort();
//console.log('DEBUG: t=', t, ', aprops.length=' + aprops.length + ', aprops[0]=' + aprops[0]+ ', transend=' + fg_params.trans_end);				
		if ((t >= start) && (t <= end)) {
			
// The next statement is to get over the problem that the time never reaches 1.0. the last time is for the last frame
// which can appear up to 1/frame-rate seconds before 1.0. Since we do not know the framerate, assume it is 24fps.

			if ((end-t) < 2*Elusien.frame_length){t = end;}
			
			if ((aprops.length > 0) && (aprops[0].match(/^\d+(.\d)*$/) !== null)){ // We have a keyframe e.g. 080, first is 000
				nkeyframes++;
				sprop    =  aprops[0];	// As a string e.g. '080'
				 prop    = +sprop;		// As a number e.g. 80
//console.log('t=', t, ', check=', (prop * duration / 100) + start);
				if (((prop * duration / 100) + start) <= t) { // the current time is >= the keyframe, so this keyframe is now active
//console.log('DEBUG: t=' + t + ', aprops[0]=' + aprops[0] + ', val=' + ex_params.explode[sprop] + ', FROM=', (+start + (prop * duration / 100)));
console.log('DIVS =', fg_params.divs.length);
					if (prop == 100) {
						switch (fg_params.state) {
							case 'defragmented':
								for (i = 0; i < fg_params.divs.length ; i++) {
									fg_params.styles[i].opacity = (fg_params.fragment.finish == 'visible') ? 1.0 : 0.0;
								}
								break;
							case 'fragmented':		
								break;
							case 'fragmenting':		// Set characters to 'fragmented' state.
								for (i = 0; i < fg_params.divs.length ; i++) {
									fg_params.styles[i].webkitTransform = 'translate(' +
										fg_params.coords[i].x + 'px , ' + fg_params.coords[i].y + 'px) scale(1.0, 1.0)'								
									;
									fg_params.styles[i].opacity = 0.0;
								}
								fg_params.state = 'fragmented';
								break;
							case 'defragmenting':		// Set characters to 'defragmented' state.
								for (i = 0; i < fg_params.divs.length ; i++) {
									fg_params.styles[i].webkitTransform = 'translate(0px , 0px) scale(1.0, 1.0)';
									fg_params.styles[i].opacity         = (fg_params.fragment.finish == 'visible') ? 1.0 : 0.0;
								}
								fg_params.state = 'defragmented';
								break;
						}
						return;
					}
					sprop_next            = aprops[1];
					 prop_next            = +sprop_next;
					trans_duration        = (prop_next - prop) / 100;
					fg_params.trans_start = t;					// Normalised time at the start of the transition
					fg_params.trans_end   = t + (duration * (prop_next - prop) / 100);
					fg_params.trans_durn  = fg_params.trans_end - fg_params.trans_start;
					fg_params.transition  = fg_params.fragment[sprop];
//console.log('fg_params.transition=', fg_params.transition, ', fg_params.state=', fg_params.state, 'fg_params.trans_end=', fg_params.trans_end);					
					switch (fg_params.transition) {
						case 'wait':
							switch (fg_params.state) {
								case 'defragmented':
								case 'fragmented':		
									break;
								case 'fragmenting':		// Set characters to 'fragmented' state.
									for (i = 0; i < fg_params.divs.length ; i++) {
										fg_params.styles[i].webkitTransform = 'translate(' +
											fg_params.coords[i].x + 'px , ' + fg_params.coords[i].y + 'px) scale(1.0, 1.0)'								
										;
										fg_params.styles[i].opacity = 0.0;
									}
									fg_params.state = 'fragmented';
									break;
								case 'defragmenting':		// Set characters to 'defragmented' state.
									for (i = 0; i < fg_params.divs.length ; i++) {
										fg_params.styles[i].webkitTransform = 'translate(0px , 0px) scale(1.0, 1.0)';
										fg_params.styles[i].opacity         = 1.0;
									}
									fg_params.state = 'defragmentated';
									break;
							}
							break;
						case 'fragment':
							switch (fg_params.state) {
								case 'defragmented':
									break;
								case 'fragmented':		
								case 'defragmenting':
								case 'fragmenting':	// Set characters to 'defragmented' state, so they can be fragmented.
									for (i = 0; i < fg_params.divs.length ; i++) {
										fg_params.styles[i].webkitTransform = 'translate(0px , 0px) scale(1.0, 1.0)';
										fg_params.styles[i].opacity         = 1.0;
									}
									fg_params.state = 'defragmented';
									break;
							}
							break;
						case 'defragment':
							switch (fg_params.state) {
								case 'fragmented':
									break;
								case 'defragmented':
								case 'defragmenting':
								case 'fragmenting':	// set characters to 'fragmented' state, so they can be defragmented.
									for (i = 0; i < fg_params.divs.length ; i++) {
										fg_params.styles[i].webkitTransform = 'translate(' +
											fg_params.coords[i].x + 'px , ' + fg_params.coords[i].y + 'px) scale(1.0, 1.0)'								
										;
										fg_params.styles[i].opacity = 0.0;
									}
									fg_params.state = 'exploded';
									break;
							}
							break;
						default:
							err = 'Illegal value for keyframe ' + sprop + ':' + fg_params.transition;
							console.log(err);
							alert(err);
							throw(err);
					}
					delete fg_params.fragment[sprop];	// Now the keyframe is active delete it from the object.
				}
			}

			switch (fg_params.transition) {
				case 'wait':		// Do nothing, the divs are static, they do not animate.
					return;
				case 'fragment':		// transition each div by 1 increment, time-offset each div by a small amount.
					for (i = 0; i < fg_params.divs.length ; i++) {
						if ((t-fg_params.trans_start) >+ 0.5 * fg_params.coords[i].d * fg_params.trans_durn) {
							toffset = t-fg_params.trans_start - 0.5 * fg_params.coords[i].d * fg_params.trans_durn;
							doffset = fg_params.trans_durn    - 0.5 * fg_params.coords[i].d * fg_params.trans_durn;
							fg_params.styles[i].webkitTransform = 'translate(' +
								fg_params.fragment.easing[fg_params.fragment.ease](toffset,0,fg_params.coords[i].x  ,doffset)	+ 'px , ' +
								fg_params.fragment.easing[fg_params.fragment.ease](toffset,0,fg_params.coords[i].y  ,doffset) + 'px) scale(' +
								fg_params.fragment.easing[fg_params.fragment.ease](toffset,1,fg_params.coords[i].z-1,doffset) + ' , ' +
								fg_params.fragment.easing[fg_params.fragment.ease](toffset,1,fg_params.coords[i].z-1,doffset) + ')'
							;
							fg_params.styles[i].opacity = fg_params.fragment.easing[fg_params.fragment.ease](toffset,1,-1,doffset);
						}
					}
					fg_params.state = (t != 1 ? 'fragmnenting' : 'fragmented'); 
					return;
				case 'defragment':		// Transition each div by 1 increment.
					for (i = 0; i < fg_params.divs.length ; i++) {
//						if ((t-fg_params.trans_start) <= fg_params.trans_durn - 0.5 * fg_params.coords[i].d * fg_params.trans_durn) { DO NOT UNCOMMENT
						if ((t-fg_params.trans_start) <= fg_params.trans_durn) {
							toffset = t-fg_params.trans_start;
							doffset = fg_params.trans_durn; //    - 0.5 * fg_params.coords[i].d * fg_params.trans_durn; DO NOT UNCOMMENT - not a good effect
//if  (i === 0) {console.log('defragment: fg_params.state=',fg_params.state, ', toffset=', toffset, ', doffset=', doffset);}
							fg_params.styles[i].webkitTransform = 'translate(' +
								fg_params.fragment.easing[fg_params.fragment.ease](toffset,fg_params.coords[i].x, -fg_params.coords[i].x,doffset)	+ 'px , ' +
								fg_params.fragment.easing[fg_params.fragment.ease](toffset,fg_params.coords[i].y, -fg_params.coords[i].y,doffset) + 'px) scale(' +
								fg_params.fragment.easing[fg_params.fragment.ease](toffset,fg_params.coords[i].z,1-fg_params.coords[i].z,doffset) + ' , ' +
								fg_params.fragment.easing[fg_params.fragment.ease](toffset,fg_params.coords[i].z,1-fg_params.coords[i].z,doffset) + ')'
							;
							fg_params.styles[i].opacity = fg_params.fragment.easing[fg_params.fragment.ease](toffset,0,1,doffset);
						}
					}
					fg_params.state = (t != 1 ? 'defragmenting' : 'defragmented'); 
					return;				
			}
							
		}
	}      // #################### END OF run_fragment ####################

	function run_stopwatch(watch, sw_params, time, frame_number, frame_rate) {

        var i=0, hh = 0, mm = 0, ss = 0, mmm = 0;
		var current_time = 0;
		var text = '';
		var t = time;
		var duration;
		var start;
		var end;
		var prop;
		var sprop;
		var aprops = [];
	
		
		if (time === 0.0) {
			sw_params.last_time     = -1;
			sw_params.frame_len     = 1000.0 / frame_rate;		// Length of a frame in msecs.
			sw_params.running_time  = 0;						// running_time  includes time spent pausing
			sw_params.current_time  = 0;						// current_time  excludes time spent pausing
			sw_params.running_frame = 0;						// running_frame includes frames spent pausing
			sw_params.current_frame = 0;						// current_frame excludes frames spent pausing
			sw_params.pausing       = false;
//console.log(frame_rate);			
			
//			for (watch = 0; watch < SW.watches.length; watch++) {
			sw_params.current_time0 = 0;
			sw_params.frame_number0 = 0;
				
			sw_params.spans = watch.children;
			for (i = 0; i < sw_params.spans.length; i++) {	// Hide those empty spans that the user doesn't want to see.
				text = sw_params.spans[i].textContent;
				
				if (text === "") {
					sw_params.spans[i].style.display = "none";
				} else {
					if (i === 0) { sw_params.frame_number0  = +text;}
					if (i === 1) { sw_params.current_time0  = +(text.replace(/^0/     , '')) * 1000 * 60 * 60;}
					if (i === 2) { sw_params.current_time0 += +(text.replace(/^0/     , '')) * 1000 * 60     ;}
					if (i === 3) { sw_params.current_time0 += +(text.replace(/^0/     , '')) * 1000          ;}
					if (i === 4) { sw_params.current_time0 += +(text.replace(/^0{1,2}/, ''))                 ;}
				}
			}
		}
		
		if (sw_params.last_time == time) {return -1;} // This frame is the same as the last one!
		
		start               = sw_params.start;
		end                 = sw_params.end;
		duration 		    = end - start;
		sw_params.last_time = time;
		aprops     = Object.getOwnPropertyNames(sw_params).sort();
//console.log('DEBUG: aprops.length=' + aprops.length + ', aprops[0]=' + aprops[0]);				
		if ((t >= start) && (t <= end)) {
// The next statement is to get over the problem that the time never reaches 1.0. the last time is for the last frame
// which can appear up to 1/frame-rate seconds before 1.0. Since we do not know the framerate, assume it is 24fps.
			if ((end-t) < 2*Elusien.frame_length){t = end;}
			if ((aprops.length > 0) && (aprops[0].match(/^\d+(.\d)*$/) !== null)){
				sprop    =  aprops[0];
				 prop     = +aprops[0];
//console.log('DEBUG: t=' + t + ', aprops[0]=' + aprops[0], ' + struct=' + JSON.stringify(sw_params[sprop], null, 4));
				if (((prop * duration / 100) + start) <= t) {
					if (typeof sw_params[sprop].pause != "undefined") {
						sw_params.pausing = true;
					} else if (typeof sw_params[sprop].resume != "undefined") {
						sw_params[sprop].resume = sw_params[sprop].resume.trim();
						sw_params.pausing = false;
						if(sw_params[sprop].resume == 'skip') {
							sw_params.current_time = sw_params.running_time;
						} else if (sw_params[sprop].resume.match(/^\d+$/) !== null) {
								sw_params.running_time  = +sw_params[sprop].resume;
								sw_params.current_time  = sw_params.running_time;
								sw_params.current_time0 = 0;
						}
					}
					delete sw_params[sprop];
				}
			}
			
// The next statement is to get over the problem that the time never reaches 1.0. the last time is for the last frame
// which can appear up to 1/frame-rate seconds before 1.0. Since we do not know the framerate, assume it is 24fps.
				
			if (frame_number !== 0) {
				sw_params.running_time  += sw_params.frame_len;	// running_time  includes time   spent pausing
				sw_params.running_frame += 1;	   				// running_frame includes frames spent pausing
			}
							
// If we are not pausing, update the values in the <span> elements.

			if (! sw_params.pausing){
				if (frame_number !== 0) {
					sw_params.current_time  += sw_params.frame_len;	// Increase current time  with "start" frame as origin
					sw_params.current_frame += 1;	   				// Increase current frame with "start" frame as origin
				}
				current_time = Math.round(sw_params.current_time + sw_params.current_time0);
				mmm          = (current_time % 1000);			// microseconds
				current_time = (current_time - mmm) / 1000;
				ss           = (current_time %   60);			// seconds
				current_time = (current_time -  ss) /   60;
				mm           = (current_time %   60);			// minutes
				current_time = (current_time -  mm) /   60;
				hh           = (current_time);					// hours		
				sw_params.spans[0].textContent = sw_params.frame_number0 + sw_params.current_frame;
				sw_params.spans[1].textContent = pad(hh,  2);
				sw_params.spans[2].textContent = pad(mm,  2);
				sw_params.spans[3].textContent = pad(ss,  2);
				sw_params.spans[4].textContent = pad(mmm, 3);
			}
		}
	}      // #################### END OF run_stopwatch ####################

	function run_subtitle(subtitle, st_params, time, frame_number, frame_rate) {

		var t = time;
		var i, span;
		
		if (time === 0.0) {
			st_params.last_time     = -1;
			st_params.frame_len     = 1000.0 / frame_rate;		// Length of a frame in msecs.
			subtitle.innerHTML = '';
			subtitle.style.visibility = 'hidden';
			return;
		}
		
		if (st_params.last_time == time) {return -1;} // This frame is the same as the last one!
		
		if (st_params.last_time === -1) {
// This is the second frame, so now we know the actual frame duration in NORMALISED time
			st_params.frame_len_norm = time;
			st_params.real_to_norm   = st_params.frame_len_norm / st_params.frame_len;
			for (i = 0; i < st_params.cues.length; i++){
				st_params.cues[i].start = st_params.cues[i].startTime * st_params.real_to_norm;
				st_params.cues[i].end   = st_params.cues[i].endTime   * st_params.real_to_norm;
			}
console.log(st_params);
console.log('LENGTH', st_params.cues.length);
		}
		
		st_params.last_time = time;
		
		if (st_params.next_cue >= 0) {
			if (st_params.cues[st_params.next_cue].start <= t) {
// This cue is not yet being processed, but starts now.				
console.log(st_params.next_cue);
				span = document.createElement('span');
				span.innerHTML = '<br>' + st_params.cues[st_params.next_cue].text.replace(/\n/g, '<br>\n');
				st_params.cues[st_params.next_cue].span       = subtitle.appendChild(span);
				st_params.cues[st_params.next_cue].processing = true;
				st_params.max_cue                             = st_params.next_cue++;
				st_params.ncues_active++;
				if (st_params.next_cue >= st_params.cues.length) {st_params.next_cue = -1;}
			}
			if (st_params.ncues_active !== 0) {subtitle.style.visibility = 'visible';}
		}

		
		if (st_params.ncues_active > 0) {	// some cues in process
			var tmp;
			var found = false;
			i       = st_params.min_cue;
			while (i <= st_params.max_cue) {
				if (st_params.cues[i].processing) {
// this cue is already being processed, see if we are past the time it should finish.
					if (st_params.cues[i].end > t) {
						if (!found) {
							found = true;
							tmp = i;	// This is the new "min_cue"
						}
					} else {
						st_params.cues[i].span.remove();	// This cue has finished - get rid of it.
						st_params.ncues_active--;
						st_params.cues[i].processing = false;
					}
				}
				i++;
			}
			
			st_params.min_cue = found ? tmp : st_params.max_cue;
				
			if (st_params.cues[st_params.min_cue].processing) {
// Remove the first '<br>'
				st_params.cues[st_params.min_cue].span.innerHTML = st_params.cues[st_params.min_cue].span.innerHTML.replace(/^<br( \/)*>/, '');
			}
			if (st_params.ncues_active === 0) {subtitle.style.visibility = 'hidden';}
		}
	}      // #################### END OF run_subtitle ####################
	
	function run_credits(credits, vc_params, time, frame_number, frame_rate) {

		var t = time;
		
		if (time === 0.0) {
			vc_params.last_time = -1;
			vc_params.frame_len = 1000.0 / frame_rate;		// Length of a frame in msecs.
console.log(vc_params);
			if (vc_params.scrolling) {
				vc_params.style.webkitTransform = 'translateY(' + vc_params.window_height + 'px)';
			}
			return;
		}
		
		if (vc_params.last_time == time) {return -1;} // This frame is the same as the last one!
		
		if (vc_params.last_time === -1) {
// This is the second frame, so now we know the actual frame duration in NORMALISED time
			vc_params.frame_len_norm = time;
		}
		
		if ((1.0-t) < 2*Elusien.frame_length){t = 1.0;}
		
// If scrolling move the credits up by a small amount.

		if (vc_params.credits.scrolling) {
			credits.style.webkitTransform = 'translateY(' + (vc_params.window_height - t * (vc_params.window_height + vc_params.credits_height)) + 'px)';
		}
		
		return;
				
	}      // #################### END OF run_credits ####################

	function run_typewriter(typewriter, tw_params, time, frame_number, frame_rate) {

		var t = time;
		var i, n;
		
		if (time === 0.0) {
			tw_params.last_time                = -1;
			tw_params.frame_len                = 1000.0 / frame_rate;		// Length of a frame in msecs.
console.log(tw_params);
			return;
		}
		
		if (tw_params.last_time == time) {return -1;} // This frame is the same as the last one!
		
		if (tw_params.last_time === -1) {
// This is the second frame, so now we know the actual frame duration in NORMALISED time
			tw_params.frame_len_norm = time;
		}
		
		tw_params.last_time = time;
		if ((t < tw_params.typewrite.start) || (t > tw_params.typewrite.end)){
			return;
		}
		
		if (Math.abs(tw_params.typewrite.end - t) < 2 * Elusien.frame_length){t = tw_params.typewrite.end;}
		
		n = tw_params.span_no;
		
		if (t == tw_params.typewrite.end) {
			tw_params.style[n-1].borderRightColor = 'transparent';
			return;
		}
		
		if (t < tw_params.typewrite.start + tw_params.typewrite.stx * tw_params.inc) {
			tw_params.style[0].borderRightColor = tw_params.borderRightColor;
			tw_params.style[0].visibility      = 'visible';
			return;
		}

		i = tw_params.spans.length;
		if (t > tw_params.typewrite.start + (tw_params.typewrite.stx + i) * tw_params.inc) { // Past last char
			return;
		}
		
		if (t > tw_params.typewrite.start + (tw_params.typewrite.stx + n) * tw_params.inc) {
			if (n === 0) {
				tw_params.style[n].borderLeftColor  = 'transparent';
				tw_params.spans[n    ].innerHTML        = tw_params.innerHTML0;
			} else {
				tw_params.style[n - 1].borderRightColor = 'transparent';
			}
			tw_params.style[n].borderRightColor = tw_params.borderRightColor;
			tw_params.style[n].visibility       = 'visible';
			tw_params.span_no++;
			return;
		}
		
	}      // #################### END OF run_typewriter ####################


	function rep_defaults(defaults, args) {
		var key;
		var dkeys  = [];
		var akeys  = [];
		var target = {};
		for (key in defaults) {
			dkeys.push(key);
			target[key] = defaults[key];
		}
		for (key in args)     {
			akeys.push(key);
			target[key] = args[key];}
		dkeys.sort();
		akeys.sort();
		return target;
	}
	
	function validate_args(args) {
		var fault = false, ok = false, key, err = 'ERROR: ';
		
		if (typeof args.validate == 'undefined') {
			error(['coding error - contact the developer.']);
			return false;
		}
		
		for (key in args) {
			if (key == 'validate') {continue;}
			if (typeof args.validate[key] == 'undefined'){
				err   += ' UNKNOWN parameter| ' + key + ': ' + args[key];
				fault = true;
			} else {
				ok = false;
				if (args[key].match(args.validate[key])) {ok = true;}
				if (!ok) {
					err += ' BAD parameter| ' + key + ': ' + args[key];
					fault = true;
				}
			}
		}
		if (fault) {error(err);}
		return fault;
	}		
	
	function Coords(x, y, z, d, o, r, s) {
		this.x = x;	// x-coord or translateX
		this.y = y;	// y-coord or translateY
		this.z = z; // x-coord or translateZ (simulated by scaling up or down by this value)
		this.d = d;	// delay (0.0 for first, almost 1.0 for last.)
		this.o = o; // opacity(o)
		this.r = r; // rotate(r + 'deg')
		this.s = s; // scale(s)
	}	
	
	function Xform(kf, st, en, kfst, kfen) {
		this.kf   = kf;		// current keyframe index (first is 0)
		this.st   = st;		// time this span STarts its transform
		this.en   = en;		// time this span ENds   its tranformation
		this.kfst = kfst;	// time this span's current Keyfram STarts its transformation
		this.kfen = kfen; // time this span's current KeyFrame ENds  its transformation
	}
	
	function Explode() {
/*
	The Explode object constructor. Set up some defaults.
*/
		this.start      = 0.0;
		this.end        = 1.0;
		this.ease       = 'easInOutSine';	// The easing to use for the explosion
		this.svis       = 'visible';		// Start visibility ('visible' / 'hidden')
		this.fvis       = 'visible';		// Start visibility ('visible' / 'hidden')
	}
	
	function Ex_Param() {
		this.explode   = [];			// An array of Explode objects
		this.spans     = [];			// the HTML_Collection of the spans with classname 'e_x_p_l_o_d_e' 
		this.styles    = [];			// the CSS style objects for the spans with classname 'e_x_p_l_o_d_e' 
		this.coords    = [];			// the x, y, z, time-delay coordinates for these spans 
		this.last_time = -1;			// used to check if the producer is called multiple times with the same time parameter
		this.frame_len = 0;				// the frame-length, in normalised time (0.0 to 10.0) units.
		this.nh        = 0;				// No if horizontal slices.
		this.nv        = 0;             // No of vertical slices.
		this.state     = 'imploded';	// 'imploded'  = initial state (characters are at their normal positions)
										// 'exploded'  = characters are at their exploded positions
										// 'imploding' = characters are in the process of imploding
										// 'exploding' = characters are in the process of exploding
										// 'waiting'   = no animation in progress
	}
	
	function Roll() {
/*
	The Roll object constructor. Set up some defaults.
*/
		this.start      = 0.0;
		this.end        = 1.0;
		this.ease       = 'easInOutSine';	// The easing to use for the roll
		this.svis       = 'visible';		// Start visibility ('visible' / 'hidden')
		this.fvis       = 'visible';		// Start visibility ('visible' / 'hidden')
	}
	
	function Rl_Param() {
		this.roll      = [];			// An array of Roll objects
		this.spans     = [];			// the HTML_Collection of the spans with classname 'e_x_p_l_o_d_e' 
		this.styles    = [];			// the CSS style objects for the spans with classname 'e_x_p_l_o_d_e' 
		this.coords    = [];			// the x, y, z, time-delay coordinates for these spans 
		this.last_time = -1;			// used to check if the producer is called multiple times with the same time parameter
		this.frame_len = 0;				// the frame-length, in normalised time (0.0 to 10.0) units.
		this.nh        = 0;				// No if horizontal slices.
		this.nv        = 0;             // No of vertical slices.
		this.state     = 'flowed';	// 'flowed  = initial state (characters are at their normal positions)
										// 'rolled'  = characters are at their rolled-up positions
										// 'flowing' = characters are in the process of flowing
										// 'rolling'   = characters are in the process of rolling (-up)
										// 'waiting'   = no animation in progress
	}
	
	function fragment() {
/*
	The fragment object constructor. Set up some defaults.
*/
		this.start      = 0.0;
		this.end        = 1.0;
		this.ease       = 'easInOutSine';	// The easing to use for the frahmentation
		this.svis       = 'visible';		// Start visibility ('visible' / 'hidden')
		this.fvis       = 'visible';		// Start visibility ('visible' / 'hidden')
	}
	
	function Fg_Param() {
		this.fragment  = [];			// An array of Fragment objects
		this.divs      = [];			// the HTML_Collection of the divs with classname 'f_r_a_g_m_e_n_t' 
		this.styles    = [];			// the CSS style objects for the divs with classname 'f_r_a_g_m_e_n_t' 
		this.coords    = [];			// the x, y, z, time-delay coordinates for these divs 
		this.last_time = -1;			// used to check if the producer is called multiple times with the same time parameter
		this.frame_len = 0;				// the frame-length, in normalised time (0.0 to 10.0) units.
		this.state     = 'defragmented';// 'defragmented'  = initial state (characters are at their normal positions)
										// 'fragmented'    = characters are at their fragmented positions
										// 'defrangmeting' = characters are in the process of defragmenting
										// 'fragmenting'   = characters are in the process of fragmenting
										// 'waiting'       = no animation in progress
	}
	
	function St_Param() {
		this.subtitle  = [];			// An array of Subtitle objects
		this.last_time = -1;			// used to check if the producer is called multiple times with the same time parameter
		this.frame_len = 0;				// the frame-length, in normalised time (0.0 to 10.0) units.
	}
	
	function Vc_Param() {
		this.credits   = [];			// An array of Credits objects (should only be one)
		this.last_time = -1;			// used to check if the producer is called multiple times with the same time parameter
		this.frame_len = 0;				// the frame-length, in normalised time (0.0 to 1.0) units.
	}
	
	function Tw_Param() {
		this.typewriter = [];			// An array of Typewriter objects
		this.spans      = [];			// the HTML_Collection of the spans with classname '_typewriter_' 
		this.style      = [];			// the CSS style objects for the spans with classname '_typewriter_'
		this.cstyle     = [];			// the CSS computed style objects for the spans with classname '_typewriter_'
		this.span_no    = 0;			// the last span that is VISIBLE
		this.last_time  = -1;			// used to check if the producer is called multiple times with the same time parameter
		this.frame_len  = 0;			// the frame-length, in normalised time (0.0 to 1.0) units.
	}
	
    function start_process() {
		
/*
        ==============================================================================================================

        Description
        -----------
        This function is called first, when all the HTML, CSS and javascript has been loaded by the browser or SHOTCUT.
        It's main function is to do a cursory check that the "data-animate" parameter is a valid JSON string,
        then it creates a Producer object by calling the Producer constructor detailed above.

        ==============================================================================================================
*/
    var easy            = new Easing_Funs(); 
    var webvfxelems     = document.getElementsByClassName('webvfx');
		var centerelems     = document.querySelectorAll('[data-center]');
    var animate         = [];
    var sw_params       = [];
		var params          = {};
		var explosions      = [];
		var ex_params       = [];
		var rollings        = [];
		var rl_params       = [];
		var fragments       = [];
		var fg_params       = [];
		var subtitles       = [];
		var st_params       = [];
		var typewriters     = [];
		var tw_params       = [];
		var credits         = [];
		var vc_params       = [];
		var slideshows      = [];
		var anims           = [];
		var stopwatches     = [];
		var animate_string  = [];
		var explosion_string = [];
		var rolling_string  = [];
		var fragment_string = [];
		var subtitle_string = [];
		var typewriter_string = [];
		var credits_string  = [];
		var data_slideshow;
    var data_animate;
		var data_stopwatch;
		var data_explosion;
		var data_rolling;
		var data_fragment;
		var data_subtitle;
		var data_typewriter;
		var data_credits;
		var pre_subtitle;
		var json;
		var i, an, sw, ss, ex, rl, fg, st, tw, vc, np;
		var ht, wd;
		var prop;
 		var	ok = true, ok_start = false, ok_end = false, ok_ease = false, ok_type = false, ok_000 = false, ok_100 = false, ok_keyframe = false, ok_t = false, ok_h = false, ok_cl = false, ok_cr = false, ok_scale = false;
    var duration    = 8;             // default duration of clip (in secs)
		
		params.browser  = (typeof webvfx == "undefined");
        Elusien.frame_rate  = 30;            // Default frame-rate (in fps)
		
        try {
            var control         = document.querySelector('[data-control]').getAttribute('data-control').split(':');
            duration            = +control[0];
            Elusien.frame_rate  = +control[1];
        }
        catch(err) {}
		
		Elusien.frame_number = 0;
		
// First center any elements that have the "data-center" attribute.

console.log(centerelems, ', ', centerelems.length);
		for (i = 0; i < centerelems.length; i++) {
			center = centerelems[i].getAttribute('data-center');
			switch (center) {
				case 'h':
				case 'v':
				case 'vh':
				case 'hv':
					break;
				default:
					err = 'ERROR: incorrect value (data-center="' + center + ')';
					error(err);
			}
			var parent        = centerelems[i].parentNode;
			var parent_cstyle = window.getComputedStyle(parent, null);
			var elem_cstyle   = window.getComputedStyle(centerelems[i], null);
			if ((parent_cstyle.position === null) || (parent_cstyle.position == 'static')) {
				parent.style.position = 'relative';
			}
			if (elem_cstyle.position != 'absolute' ) {
				centerelems[i].style.position = 'absolute';
			}
			switch (center) {
				case 'v':
				case 'vh':
				case 'hv':
					centerelems[i].style.top  = 0.5 * (parent.offsetHeight - centerelems[i].offsetHeight);
				case 'h':
				case 'vh':
				case 'hv':
					centerelems[i].style.left = 0.5 * (parent.offsetWidth  - centerelems[i].offsetWidth);
					break;
			}
		}

		for (i = 0, an=0, sw=0, ss=0, ex=0, rl=0, fg=0, st=0, tw=0, vc=0, np=0; i < webvfxelems.length; i++) {
			if (webvfxelems[i].hasAttribute('data-animate'   )){
				         anims[an] = webvfxelems[i];
				animate_string[an] = anims[an].getAttribute('data-animate' );
				an++;
			}
			if (webvfxelems[i].hasAttribute('data-animate2'  )){
				         anims[an] = webvfxelems[i];
				animate_string[an] = anims[an].getAttribute('data-animate2');
				an++;
			}
			if (webvfxelems[i].hasAttribute('data-stopwatch' )){
				stopwatches[sw++] = webvfxelems[i];
			}
			if (webvfxelems[i].hasAttribute('data-slideshow' )){
				slideshows[ss++] = webvfxelems[i];
			}
			if (webvfxelems[i].hasAttribute('data-explosion' )){
					     ex_params[ex] = new Ex_Param(); 
				      explosions[ex] = webvfxelems[i];
				explosion_string[ex] = explosions[ex].getAttribute('data-explosion' );
				ex++;
			}
			if (webvfxelems[i].hasAttribute('data-credits')){
					   vc_params[vc] = new Vc_Param(); 
				       credits[vc] = webvfxelems[i];
				credits_string[vc] = credits[vc].getAttribute('data-credits' );
				vc++;
			}
			if (webvfxelems[i].hasAttribute('data-textflow' )){
					   rl_params[rl] = new Rl_Param(); 
				      rollings[rl] = webvfxelems[i];
				rolling_string[rl] = rollings[rl].getAttribute('data-textflow' );
				if (vc_params.length !== 0) { rl_params[rl].vc_params = vc_params[0]; }
				rl++;
			}
			if (webvfxelems[i].hasAttribute('data-fragment'  )){
					    fg_params[fg] = new Fg_Param(); 
				      fragments[fg] = webvfxelems[i];
				fragment_string[fg] = fragments[fg].getAttribute('data-fragment' );
				fg++;
			}
			if (webvfxelems[i].hasAttribute('data-subtitles' )){
					    st_params[st] = new St_Param(); 
				      subtitles[st] = webvfxelems[i];
				subtitle_string[st] = subtitles[st].getAttribute('data-subtitles' );
				st++;
			}
			if (webvfxelems[i].hasAttribute('data-typewriter')){
					      tw_params[tw] = new Tw_Param(); 
				      typewriters[tw] = webvfxelems[i];
				typewriter_string[tw] = typewriters[tw].getAttribute('data-typewriter' );
				tw++;
			}


		}
		
// First process the slideshow, if it exists.
// ##########################################

		if (ss > 1){
			err = 'There can only be 1 slideshow, you have ' + ss;
			alert(err);
			throw(err);
		}
		
		if (ss == 1) {
			var ss_defaults = {
				type		: 'sliding',
				from		: 'right'  ,
				duration	: '25%'    ,
				magnify		: '25%'    ,
				blur		: '0'      ,
				ease		: 'linearTween' ,
				ofrom		: 'right'  ,
				validate 	: {
					type		: /^(sliding|shuffling|appearing|expanding|stretching|splitting)$/i ,
					from		: /^(top|bottom|left|right)$/i ,
					duration	: /^\d+.{0,1}\d*%{1}$/         ,
					magnify		: /^\d+.{0,1}\d*%{1}$/         ,
					blur		: /^\d+.{0,1}\d*$/			  ,
					ease		: /^(linearTween|easeInQuad|easeOutQuad|easeInOutQuad|easeInCubic|easeOutCubic|easeInOutCubic|easeInQuart|easeOutQuart|easeInOutQuart|easeInQuint|easeOutQuint|easeInOutQuint|easeInSine|easeOutSine|easeInOutSine|easeInExpo|easeOutExpo|easeInOutExpo|easeInCirc|easeOutCirc|easeInOutCirc|easeInBounce|easeOutBounce|easeInOutBounce)$/ ,
					ofrom		: /^(top|bottom|left|right)$/i
				}
			};
	
			var slideshow = {};
			
			data_slideshow = slideshows[0].getAttribute("data-slideshow");
			if (data_slideshow !== '') {
//console.log('DEBUG: data_slideshow='+ data_slideshow);
				json = slideshow_to_JSON_string(data_slideshow);
//console.log('DEBUG: json='+ json);
				try {
	               slideshow = JSON.parse(json);
	            }
	            catch(err) {
	                console.log("Error in slideshow: " + err + "\n" + slideshows[0].getAttribute("data-slideshow"));
	                      alert("Error in slideshow: " + err + "\n" + slideshows[0].getAttribute("data-slideshow"));
	                throw(err);
	            }
			}
			
			slideshow = rep_defaults(ss_defaults, slideshow);
			if ((slideshow.type == 'appearing') || (slideshow.type == 'expanding') || (slideshow.type == 'stretching')){
				slideshow.ofrom = slideshow.from;
				slideshow.from  = 'right';
			}
//console.log('DEBUG:' + JSON.stringify(slideshow, null, 4));
			
			ok = validate_args(slideshow);	// @@@@@@@@@@@ Do some better checking @@@@@@@@@@@@@@@
			
			
			slideshow.slide_this    =  0;
			slideshow.slide_prev    = -1;
			slideshow.trans_pcnt    = parseFloat(slideshow.duration);
			slideshow.images        = slideshows[0].getElementsByTagName("img");
			slideshow.images_loaded = true;
			slideshow.last_time     = -1;
			slideshow.magnify       = parseFloat(slideshow.magnify) / 100;
			slideshow.easing 		= easy;

			
			if (slideshow.trans_pcnt === 0) {
				slideshow.type = 'static';
				slideshow.from = 'right';
			}

			switch (slideshow.from) {
				case 'right' :
						slideshow.dirn = 'left';
						slideshow.sign = +1;
						slideshow.horv = 'hriz';
						break;
				case 'left' :
						slideshow.dirn = 'left';
						slideshow.sign = -1;
						slideshow.horv = 'hriz';
						break;
				case 'top' :
						slideshow.dirn = 'top';
						slideshow.sign = -1;
						slideshow.horv = 'vert';
						break;
				case 'bottom' :
						slideshow.dirn = 'top';
						slideshow.sign = +1;
						slideshow.horv = 'vert';
						break;
			}
						
// CHECK THE PARAMETERS HERE

// Centre the slideshow on the page.

			var ss_parent = slideshows[0].parentElement;
			ht            = ss_parent.offsetHheight;
			wd            = ss_parent.offsetWidth;
			wd			  		= ss_parent.getBoundingClientRect().width;
//console.log('BODY: ht=' + ht + ', wd=', wd );


			slideshows[0].style.position = 'relative';

// This is an easy way of centering. Unfortunately it won't work in Shotcut-MLT
// as it then gives just the margin widths as the Width and Height of the slideshow!!!
// It does work in a modern browser.

//			slideshows[0].style.top      = 0;
//			slideshows[0].style.left     = 0;
//			slideshows[0].style.bottom   = 0;
//			slideshows[0].style.right    = 0;
//			slideshows[0].style.margin   = 'auto';

			
			for (i = 0; i < slideshow.images.length; i++) {
				var style  = slideshow.images[i].style;
				ht_offset  = 50;
				wd_offset  = 50;
//console.log(ht, '=', mrgn_top, '=', ht_offset,'=',cstyle.getPropertyValue('margin-top' ));
//				slideshow.images[i].setAttribute('onload' , 'image_loaded(true)' );
//				slideshow.images[i].setAttribute('onerror', 'image_loaded(false)');
													  			
				if (slideshow.horv == 'hriz') {
					style.display         = 'none';
					style.position        = 'absolute';
					style.left            = '100%';
					style.top             = '50%';
					style.webkitTransform = 'translateY(-' + ht_offset + '%)'; //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
				} else if (slideshow.horv == 'vert') {
					style.display         = 'none';
					style.position        = 'absolute';
					style.top             = '100%';
					style.left            = '50%';
					style.webkitTransform = 'translateX(-' + wd_offset + '%)'; 
				} else {
					alert('error:' + slideshow.horv + ', ' + slideshow.from);
				}
			}
		
			params[np++] = {slideshow: slideshows[0], ss_params: slideshow};
			
		}

// Now process any explosions.
// ###########################
				
		for  (ex = 0; ex < explosions.length; ex++) {
            data_explosion = explosion_string[ex];
			if (data_explosion === ''){
				data_explosion = '{start: 0.0, end: 1.0, ease: easeInOutSine, 75%: explode}';
			}
//console.log(data_explosion);
            json         = explosion_to_JSON_string(data_explosion);
//console.log('DEBUG: json='+ json);
			try {
               ex_params[ex].explode = JSON.parse(json);
            }
            catch(err) {
                console.log("Error in explosion number " + (ex+1) + ": " + err + "\n" + explosion_string[ex]);
                      alert("Error in explosion number " + (ex+1) + ": " + err + "\n" + explosion_string[ex]);
                throw(err);
            }
//console.log('DEBUG:' + JSON.stringify(ex_params[ex].explode, null, 4));

			ok            = true;
			ok_start      = false;
			ok_end        = false;
			ok_ease       = false;
			ok_begin      = false;
			ok_finish     = false;
			ok_000        = false;
			ok_100        = false;
			ok_keyframe   = true;
				
			for (prop in ex_params[ex].explode) {
				switch (prop) {
					case 'start':
						ok_start = true;
						break;
					case 'end':
						ok_end   = true;
						break;
					case 'ease':
						ok_ease  = true;
						break;
					case 'begin':
						ok_begin  = true;
						break;
					case 'finish':
						ok_finish  = true;
						break;
						break;
					case '000':
						ok_000   = true;
						break;
					case '100':
						ok_100   = true;
						break;
					default:
						ok_keyframe = prop.match(/\d\d\d(.\d*)*/);
						if (!ok_keyframe) {ok = false;}
//console.log('VAR=' + prop + ', OK=' + ok);
				}
			}
			
			if (!ok_start ) {ex_params[ex].explode.start  = 0.0;}
			if (!ok_end   ) {ex_params[ex].explode.end    = 1.0;}
			if (!ok_ease  ) {ex_params[ex].explode.ease   = "easeInOutSine";}
			if (!ok_begin ) {ex_params[ex].explode.begin  = "visible";}
			if (!ok_finish) {ex_params[ex].explode.finish = "visible";}
			if (!ok_000   ) {ex_params[ex].explode['000'] = 'wait';}
			if (!ok_100   ) {ex_params[ex].explode['100'] = 'wait';}
			
			if (!(ok = ok_keyframe)) {
				console.log("Error in explosion number " + (ex+1) + ': bad keyword:\n' + data_explosion + '\n');
                      alert("Error in explosion number " + (ex+1) + ': bad keyword:\n' + data_explosion + '\n');
                throw('Badly formatted explosion request.');
			}
			
			ex_params[ex].explode.easing = easy;
			format_explosion_data(explosions[ex], ex_params[ex]);
			
//console.log('DEBUG: animate=' + JSON.stringify(exlode[ex], null, 4));
			
      params[np++] = {explosion: explosions[ex], ex_params: ex_params[ex]};
//console.log(params[np-1]);
    }
		

// Now process any video CREDITS (THIS MUST BE DONE BEFORE ROLLINGS [TEXTFLOW])
// #############################  ############################################
				
		for  (vc = 0; vc < credits_string.length; vc++) {
      data_credits = credits_string[vc];
			if (data_credits === ''){
				data_credits = "{scrolling: 'true', t: 'none|none|none', h: 'none|none|none', cl: 'none|none|none', cr: 'none|none|none'}";
			}
console.log(data_credits);
      json = credits_to_JSON_string(data_credits);
console.log('DEBUG: json='+ json);
			try {
               vc_params[vc].credits = JSON.parse(json);
            }
            catch(err) {
                console.log("Error in credits number " + (vc+1) + ": " + err + "\n" + credits_string[vc]);
                      alert("Error in credits number " + (vc+1) + ": " + err + "\n" + credits_string[vc]);
                throw(err);
            }
//console.log('DEBUG:' + JSON.stringify(vc_params[vc].typewrite, null, 4));

			ok    = true;
			ok_scrolling = false;
			ok_t  = false;
			ok_h  = false;
			ok_cl = false;
			ok_cr = false;

			for (prop in vc_params[vc].credits) {
				switch (prop) {
					case 'scrolling':
						ok_scrolling = true;
						vc_params[vc].credits.scrolling = (vc_params[vc].credits.scrolling === true) || (vc_params[vc].credits.scrolling === 'true');
						break;
					case 't':
						ok_t  = true;
						break;
					case 'h':
						ok_h  = true;
						break;
					case 'cl':
						ok_cl = true;
						break;
					case 'cr':
						ok_cr = true;
						break;
					default:
						ok = false;
//console.log('VAR=' + prop + ', OK=' + ok);
				}
			}
			
			if (!ok_scrolling) {vc_params[vc].credits.scolling = false;}
			if (!ok_t        ) {vc_params[vc].credits.t        = 'none|none';}
			if (!ok_h        ) {vc_params[vc].credits.h        = 'none|none';}
			if (!ok_cl       ) {vc_params[vc].credits.cl       = 'none|none';}
			if (!ok_cr       ) {vc_params[vc].credits.cr       = 'none|none';}
						
			format_credits_data(credits[vc], vc_params[vc]);
			
//console.log('DEBUG: creditss=' + JSON.stringify(credits[vc], null, 4));
			
      params[np++] = {credits: credits[vc], vc_params: vc_params[vc]};
//console.log(params[np-1]);
    }


// Now process any rollings.
// #########################

console.log(rollings);				
		for  (rl = 0; rl < rollings.length; rl++) {
            data_rolling = rolling_string[rl];
			if (data_rolling === ''){
				data_rolling = '{start: 0.0, end: 1.0, ease: easeInOutSine, type: 0, 0%: flow}';
			}
//console.log(data_rolling);
            json         = rolling_to_JSON_string(data_rolling);
//console.log('DEBUG: json='+ json);
			try {
               rl_params[rl].roll = JSON.parse(json); 
            }
            catch(err) {
                console.log("Error in rolling number " + (rl+1) + ": " + err + "\n" + rolling_string[rl]);
                      alert("Error in rolling number " + (rl+1) + ": " + err + "\n" + rolling_string[rl]);
                throw(err);
            }
//console.log('DEBUG:' + JSON.stringify(rl_params[rl].roll, null, 4));

			ok            = true;
			ok_start      = false;
			ok_end        = false;
			ok_ease       = false;
			ok_begin      = false;
			ok_finish     = false;
			ok_type       = false;
			ok_scale      = false;
			ok_000        = false;
			ok_100        = false;
			ok_keyframe   = true;
				
			for (var prop in rl_params[rl].roll) {
				switch (prop) {
					case 'start':
						ok_start = true;
						break;
					case 'end':
						ok_end   = true;
						break;
					case 'ease':
						ok_ease  = true;
						break;
					case 'begin':
						ok_begin  = true;
						break;
					case 'finish':
						ok_finish  = true;
						break;
					case 'type':
						ok_type  = true;
						break;
					case 'scale':
						ok_scale = true;
						break;
					case '000':
						ok_000   = true;
						break;
					case '100':
						ok_100   = true;
						break;
					default:
						ok_keyframe = prop.match(/\d\d\d(.\d*)*/);
						if (!ok_keyframe) {ok = false;}
//console.log('VAR=' + prop + ', OK=' + ok);
				}
			}
			
			if (!ok_start ) {rl_params[rl].roll.start  = 0.0;}
			if (!ok_end   ) {rl_params[rl].roll.end    = 1.0;}
			if (!ok_ease  ) {rl_params[rl].roll.ease   = "easeInOutSine";}
			if (!ok_begin ) {rl_params[rl].roll.begin  = "hidden";}
			if (!ok_finish) {rl_params[rl].roll.finish = "visible";}
			if (!ok_type  ) {rl_params[rl].roll.type   = 0;}
			if (!ok_scale || (rl_params[rl].roll.scale === 'false') || (rl_params[rl].roll.scale === false)){
				rl_params[rl].roll.scale  = false;
			} else {
				rl_params[rl].roll.scale  = true;
			}
			
			if (!ok_000   ) {rl_params[rl].roll['000'] = 'flow';}
			if (!ok_100   ) {rl_params[rl].roll['100'] = 'wait';}
			
			if (!(ok = ok_keyframe)) {
				console.log("Error in rolling number " + (rl+1) + ': bad keyword:\n' + data_rolling + '\n');
                      alert("Error in rolling number " + (rl+1) + ': bad keyword:\n' + data_rolling + '\n');
                throw('Badly formatted rolling request.');
			}

			rl_params[rl].roll.easing = easy;
			
			if (+rl_params[rl].roll.type >= ANIMS.length) {
				console.log("Error in rolling number " + (rl+1) + ': type parameter too large:\n' + data_rolling + '\n');
                      alert("Error in rolling number " + (rl+1) + ': type parameter too large:\n' + data_rolling + '\n');
                throw('Badly formatted rolling request.');				
			}
			

			rl_params[rl].animparams   = ANIMS[rl_params[rl].roll.type];
console.log('========================================rl_params[rl].roll.scale=', rl_params[rl].roll.scale);			
			if (rl_params[rl].roll.scale){
				var font_size = parseInt(window.getComputedStyle(rollings[rl]).getPropertyValue('font-size'), 10);
				rl_params[rl].animparams.forEach(function(obj){
console.log('########################################font_size=', font_size, obj, obj.translate[0], obj.translate[1]);
					obj.translate[0] *= font_size / 32;
					obj.translate[1] *= font_size / 32;
console.log('========================================font_size=', font_size, obj, obj.translate[0], obj.translate[1]);
				});
			}

			if (Left(rl_params[rl].roll.start, 3) == 'vc|') {
				var pcnt = rl_params[rl].roll.start.split('|')[1];
				rl_params[rl].roll.start = rl_params[rl].vc_params.start[rollings[rl].parentNode.getAttribute('data-row')*1];
				rl_params[rl].roll.end   = rl_params[rl].roll.start + 0.01 * pcnt;
console.log('rl_params[rl].roll.start=' + rl_params[rl].roll.start + ', rl_params[rl].roll.end=', rl_params[rl].roll.end);
			}
			
			format_rolling_data(rollings[rl], rl_params[rl]);
			
//console.log('DEBUG: animate=' + JSON.stringify(rollings[rl], null, 4));
			
      params[np++] = {rolling: rollings[rl], rl_params: rl_params[rl]};
console.log(params[np-1]);
    }
		

// Now process any fragmentations.
// ###############################
				
		for  (fg = 0; fg < fragments.length; fg++) {
            data_fragment = fragment_string[fg];
			if (data_fragment === ''){
				data_fragment = '{start: 0.0, end: 1.0, ease: easeInOutSine, 75%: fragment}';
			}
//console.log(data_fragment);
            json         = fragment_to_JSON_string(data_fragment);
//console.log('DEBUG: json='+ json);
			try {
               fg_params[fg].fragment = JSON.parse(json);
            }
            catch(err) {
                console.log("Error in fragmentation number " + (fg+1) + ": " + err + "\n" + fragment_string[fg]);
                      alert("Error in fragmentation number " + (fg+1) + ": " + err + "\n" + fragment_string[fg]);
                throw(err);
            }
//console.log('DEBUG:' + JSON.stringify(fg_params[fg].fragment, null, 4));

			ok            = true;
			ok_start      = false;
			ok_end        = false;
			ok_ease       = false;
			ok_begin      = false;
			ok_finish     = false;
			ok_nh         = false;
			ok_nv		  = false;
			ok_000        = false;
			ok_100        = false;
			ok_keyframe   = true;
				
			for (var prop in fg_params[fg].fragment) {
				switch (prop) {
					case 'start':
						ok_start = true;
						break;
					case 'end':
						ok_end   = true;
						break;
					case 'ease':
						ok_ease  = true;
						break;
					case 'begin':
						ok_begin  = true;
						break;
					case 'finish':
						ok_finish  = true;
						break;
					case 'nh':
						ok_nh	 = true;
						break;
					case 'nv':
						ok_nv	 = true;
						break;
					case '000':
						ok_000   = true;
						break;
					case '100':
						ok_100   = true;
						break;
					default:
						ok_keyframe = prop.match(/\d\d\d(.\d*)*/);
						if (!ok_keyframe) {ok = false;}
//console.log('VAR=' + prop + ', OK=' + ok);
				}
			}
			
			if (!ok_start ) {fg_params[fg].fragment.start  = 0.0;}
			if (!ok_end   ) {fg_params[fg].fragment.end    = 1.0;}
			if (!ok_ease  ) {fg_params[fg].fragment.ease   = "easeInOutSine";}
			if (!ok_begin ) {fg_params[fg].fragment.begin  = "visible";}
			if (!ok_finish) {fg_params[fg].fragment.finish = "visible";}
			if (!ok_nh    ) {fg_params[fg].fragment.nh     = 2;}
			if (!ok_nv    ) {fg_params[fg].fragment.nv     = 2;}
			if (!ok_000   ) {fg_params[fg].fragment['000'] = 'wait';}
			if (!ok_100   ) {fg_params[fg].fragment['100'] = 'wait';}
			
			if (!(ok = ok_keyframe)) {
				console.log("Error in fragmentation number " + (fg+1) + ': bad keyword:\n' + data_fragment + '\n');
                      alert("Error in fragmentation number " + (fg+1) + ': bad keyword:\n' + data_fragment + '\n');
                throw('Badly formatted fragmentation request.');
			}
			
			fg_params[fg].fragment.easing = easy;
			format_fragment_data(fragments[fg], fg_params[fg]);
			
//console.log('DEBUG: fragment=' + JSON.stringify(fragment[fg], null, 4));
			
            params[np++] = {fragment: fragments[fg], fg_params: fg_params[fg]};
console.log(params[np-1]);
        }

// Now process any subtitles.
// ##########################
				
		for  (st= 0; st < subtitles.length; st++) {
            data_subtitle = subtitle_string[st];
			if (data_subtitle === ''){
				continue;
			}
			
			pre_subtitle = document.getElementById(data_subtitle);
            str_string   = pre_subtitle.innerText;
			pre_subtitle.style.display = 'none';
//console.log(str_string);

			try {
               st_params[st].cues = fromSrt(str_string); 
            }
            catch(err) {
                console.log("Error in subtitle number " + (st+1) + ": " + err + "\n" + subtitle_string[st]);
                      alert("Error in subtitle number " + (st+1) + ": " + err + "\n" + subtitle_string[st]);
                throw(err);
            }
			
			st_params[st].next_cue     = 0;			
			st_params[st].min_cue      = 0;			
			st_params[st].max_cue      = 0;
			st_params[st].ncues_active = 0;
			
            params[np++] = {subtitle: subtitles[st], st_params: st_params[st]};
//console.log(params[np-1]);
        }

// Now process any typewriters.
// ###########################
				
		for  (tw = 0; tw < typewriters.length; tw++) {
            data_typewriter = typewriter_string[tw];
			if (data_typewriter === ''){
				data_typewriter = '{start: 0.0, end: 1.0, stx: 3, etx: 3}';
			}
console.log(data_typewriter);
            json         = typewriter_to_JSON_string(data_typewriter);
console.log('DEBUG: json='+ json);
			try {
               tw_params[tw].typewrite = JSON.parse(json);
            }
            catch(err) {
                console.log("Error in typewriter number " + (tw+1) + ": " + err + "\n" + typewriter_string[tw]);
                      alert("Error in typewriter number " + (tw+1) + ": " + err + "\n" + typewriter_string[tw]);
                throw(err);
            }
//console.log('DEBUG:' + JSON.stringify(tw_params[tw].typewrite, null, 4));

			ok            = true;
			ok_start      = false;
			ok_end        = false;
			ok_stx        = false;
			ok_etx        = false;
			ok_cursor     = false;
				
			for (var prop in tw_params[tw].typewrite) {
				switch (prop) {
					case 'start':
						ok_start = true;
						break;
					case 'end':
						ok_end   = true;
						break;
					case 'stx':
						ok_stx   = true;
						break;
					case 'etx':
						ok_etx   = true;
						break;
					default:
						ok = false;
//console.log('VAR=' + prop + ', OK=' + ok);
				}
			}
			
			if (!ok_start ) {tw_params[tw].typewrite.start  = 0.0;}
			if (!ok_end   ) {tw_params[tw].typewrite.end    = 1.0;}
			if (!ok_stx   ) {tw_params[tw].typewrite.stx    = 3;}
			if (!ok_etx   ) {tw_params[tw].typewrite.etx    = 3;}
			
			tw_params[tw].typewrite.start *= 1;	// Convert from string to number
			tw_params[tw].typewrite.end   *= 1;	// Convert from string to number
			tw_params[tw].typewrite.stx   *= 1;	// Convert from string to number
			tw_params[tw].typewrite.etx   *= 1;	// Convert from string to number
						
			format_typewriter_data(typewriters[tw], tw_params[tw]);
			
//console.log('DEBUG: typewriters=' + JSON.stringify(typewriters[tw], null, 4));
			
            params[np++] = {typewrite: typewriters[tw], tw_params: tw_params[tw]};
//console.log(params[np-1]);
        }
		
// Now process any animations.

        for (an = 0; an < anims.length; an++) {
            data_animate = animate_string[an];
//console.log(data_animate);
            json         = animate_to_JSON_string(data_animate);
//console.log('DEBUG: json='+ json);
			try {
               animate[an] = JSON.parse(json);
            }
            catch(err) {
                console.log("Error in animation number " + (an+1) + ": " + err + "\n" + animate_string[an]);
                      alert("Error in animation number " + (an+1) + ": " + err + "\n" + animate_string[an]);
                throw(err);
            }
//console.log('DEBUG:' + JSON.stringify(animate[an], null, 4));

			ok          = true;
			ok_start    = false;
			ok_end      = false;
			ok_ease     = false;
			ok_000      = false;
			ok_100      = false;
			ok_keyframe = true;
				
			for (var prop in animate[an]) {
				switch (prop) {
					case 'start':
						ok_start = true;
						break;
					case 'end':
						ok_end   = true;
						break;
					case 'ease':
						ok_ease  = true;
						break;
					case '000':
						ok_000   = true;
						break;
					case '100':
						ok_100   = true;
						break;
					default:
						ok_keyframe = prop.match(/\d\d\d(.\d*)*/);
						if (!ok_keyframe) {ok = false;}
				}
			}
			
			if (!ok_start) {
				animate[an].start = 0.0;
			}
			
			if (!ok_end) {
				animate[an].end = 1.0;
			}
			
			if (!ok_ease) {
				animate[an].ease = "linearTween";
			}
			
			if (ok) {ok = ok_000 && ok_100 && ok_keyframe;}
			
			if (! ok ) {
				console.log("Error in animation number " + (an+1) + ': bad keyword:\n' + data_animate + '\n, 0%=' + ok_000 + ', 100%=' + ok_100);
                      alert("Error in animation number " + (an+1) + ': bad keyword:\n' + data_animate + '\n, 0%=' + ok_000 + ', 100%=' + ok_100);
                throw('Badly formatted animation request, 0%=' + ok_000 + ', 100%=' + ok_100);
			}
			
			format_animate(animate[an]);
			
//console.log('DEBUG: animate=' + JSON.stringify(animate[i], null, 4));
			
            params[np++] = {style: anims[an].style, animate: animate[an], easing: easy};
//console.log(params[np-1]);
        }

// Now process any stopwatches.

    for (sw = 0; sw < stopwatches.length; sw++) {
            data_stopwatch = stopwatches[sw].getAttribute("data-stopwatch");
			if (data_stopwatch === "") {
				json = "{}";
			} else {
				json = stopwatch_to_JSON_string(data_stopwatch);
			}
//console.log('DEBUG: json='+ json);
			try {
               sw_params[sw] = JSON.parse(json);
            }
            catch(err) {
                console.log("Error in stopwatch number " + (sw+1) + ": " + err + "\n" + data_stopwatch);
                      alert("Error in stopwatch number " + (sw+1) + ": " + err + "\n" + data_stopwatch);
                throw(err);
            }
//console.log('DEBUG:' + JSON.stringify(sw_params[sw], null, 4));

			ok          = true;
			ok_start    = false;
			ok_end      = false;
			ok_keyframe = true;
				
			for (var prop in sw_params[sw]) {
				switch (prop) {
					case 'start':
						ok_start = true;
						break;
					case 'end':
						ok_end   = true;
						break;
					default:
						ok_keyframe = prop.match(/\d\d\d(.\d*)*/);
						if (!ok_keyframe) {ok = false;}
				}
			}
			
			if (!ok_start) {
				sw_params[sw].start = 0.0;
			}
			
			if (!ok_end) {
				sw_params[sw].end = 1.0;
			}
			
			if (ok) {ok = ok_keyframe;}
			
			if (! ok ) {
				console.log("Error in stopwatch number " + (sw+1) + ': bad keyword:\n' + data_stopwatch);
                      alert("Error in stopwatch number " + (sw+1) + ': bad keyword:\n' + data_stopwatch);
                throw('Badly formatted stopwatch request');
			}
            params[np++] = {stopwatch: stopwatches[sw], sw_params: sw_params[sw]};
		}
				
				
				

        var producer = new Producer(params);
        
/*
        ==============================================================================================================
        Description
        -----------
        The following code checks to see if we are running as an Overlay HTML filter in SHOTCUT, or simply running in
        a browser window.
        If we are in SHOTCUT this code is skipped, as we use the SHOTCUT webvfx object.
        If we are in a Browser, we create our own webvfx object and use javascript's setTimeout function to call the render function
        for each frame to manipulate the objects' CSS properties to produce the animation.
    
        It is much, much easier to develop and debug a SHOTCUT Overlay HTML Filter in a browser than in SHOTCUT itself. You have access
        to all of the browser's development tools, like inspecting HTML elements, as well as being able to send debug information to
        the javascript console and check it for error messages. Once you have done the development there you simple call this HTML file
        as a WebVfx-enabled Overlay HTML filter in SHOTCUT without having to make any changes to it at all.
        ==============================================================================================================
*/

        if (typeof webvfx == "undefined") {

			Elusien.iter       = 0;								/* current "frame" number */
            Elusien.delay      = 1000/Elusien.frame_rate;       /* length (in msecs) of a frame */
            Elusien.niters     = duration*Elusien.frame_rate;   /* total number of frames in the clip */
            webvfx = {
                        readyRender : function(torf){   
                            var timeout_loop = function(){
                                setTimeout(function(){
                                    var time = Elusien.iter / Elusien.niters;
                                    webvfx.renderRequested.prod.render(time);
                                    if (Elusien.iter++ < (Elusien.niters - 1))  timeout_loop();
                                }, Elusien.delay);
                            };  
                            timeout_loop(); /* call the routine once, then it calls itself recursively */           
                        },
                        renderRequested : {connect : function(prod, render_fun){this.prod = prod;}}
            };
        } 		// ..................... END OF if (typeof webvfx == "undefined") ....................
        
        webvfx.renderRequested.connect(producer, Producer.prototype.render);

        webvfx.readyRender(true);  // This starts the rendering process.
    }       // #################### END OF start_process ####################

//  ################################################################################################
    window.addEventListener("load", function(){start_process();}, false); // DO NOT CHANGE THIS LINE
//  ################################################################################################    
