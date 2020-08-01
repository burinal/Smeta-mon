'use strict';

// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Dropdown menu control
(function(){
	var burgerBut = document.querySelector('header > .bottom > div > .burger_menu'),
		drowdownMenu = document.querySelector('header > .bottom > div > .dropdown_menu'),
		hideTimeout;

	// Remove opacity attribute for dropdown menu
	setTimeout(function(){
		drowdownMenu.style.opacity = '';
	}, 300);

	function hideDropdown(){
		burgerBut.classList.remove('opened');
		drowdownMenu.classList.remove('opened');
		if(hideTimeout){
			clearTimeout(hideTimeout);
		};
	};

	document.querySelector('body header .dropdown_menu .additional_close_but').addEventListener('click', function(){
		hideDropdown();
	});

	// Open/Close dropdown menu
	burgerBut.addEventListener('click', function(){
		// Show dropdown if it's not showed already
		if(!(this.classList.contains('opened'))){
			setTimeout(function(){
				burgerBut.classList.add('opened');
				drowdownMenu.classList.add('opened');
				clearTimeout(hideTimeout);
			}, 50);

			// Hide dropdown in 1000ms after opening
			var hideTimeout = setTimeout(function(){hideDropdown()}, 1000);
			var hideInterval;

			// Set timeout when user's pointer is moved from burger menu button area
			document.querySelector('header > .bottom .burger_menu').addEventListener('mouseleave', function(){
				hideTimeout = setTimeout(function(){hideDropdown()}, 1000);
			});

			// Clear timeout when user's pointer is over the burger menu button area
			document.querySelector('header > .bottom .burger_menu').addEventListener('mouseenter', function(){
				clearTimeout(hideTimeout);
			});

			// Clear timeout when user's pointer is over the dropdown
			drowdownMenu.addEventListener('mouseenter', function(){
				clearTimeout(hideTimeout);
			});

			// Set hide timeout again when user's pointer moved out from dropdown menu
			drowdownMenu.addEventListener('mouseleave', function(){
				hideTimeout = setTimeout(function(){hideDropdown()}, 1000);
			});
		} else{
			// Hide menu if it's already showed
			burgerBut.classList.remove('opened');
			drowdownMenu.classList.remove('opened');
			clearTimeout(hideTimeout);
		};
	});

	// Set top indent for invisible close area which needed to close dropdown menu on touch displays by clicking on the are below the dropdown menu
	// For 1000px width screens and below
	var invisibleCloseArea = document.querySelector('header > .bottom > div > .burger_menu > span');
	invisibleCloseArea.style.top = 'calc(' + drowdownMenu.getBoundingClientRect().height + 'px + 50px)';
}());


// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Doors construction block control
(function(){
	var tabsBlocks = document.querySelectorAll('main > section.doors_construction > .type_select'),
		contentBlocks = document.querySelectorAll('main > section.doors_construction > .details_block'),
        propsBlocks = document.querySelectorAll('main section.doors_details_table'),
		currentTabNum = 0;

	function changeTab(targetTabNum){

		// Run adaptive change tab function on 740 width screen size and below
		if(window.innerWidth <= 740){
			changeTabAdaptive(targetTabNum);
			return;
		};

		// If we clicked on tab which already active than skip
		if(+targetTabNum == +currentTabNum){
			return;
		};

		// Step 1 - remove 'active' class from all tabs
		for(let i = 0; i < tabsBlocks.length; i++){
			tabsBlocks[i].classList.remove('active');
		};

		// Step 2 - assign 'active' class to the target tab
		tabsBlocks[+targetTabNum].classList.add('active');

		// Step 3 - remove 'visible' class from all content blocks
		for(let i = 0; i < tabsBlocks.length; i++){
			contentBlocks[i].classList.remove('visible');
            propsBlocks[i].classList.remove('visible');
		};

		// Step 4 - set target content block height to current content block height
			// We sill set height value first to let height animation play
		setTimeout(function(){
			contentBlocks[+currentTabNum].style.height =
			contentBlocks[+currentTabNum].getBoundingClientRect().height + 'px';
            propsBlocks[+currentTabNum].style.height =
            propsBlocks[+currentTabNum].getBoundingClientRect().height + 'px';

			contentBlocks[+currentTabNum].style.height =
			contentBlocks[+targetTabNum].getBoundingClientRect().height + 'px';
            propsBlocks[+currentTabNum].style.height =
                propsBlocks[+targetTabNum].getBoundingClientRect().height + 'px';
		}, 100);

		// Step 5 - set position_static class to target tab and position_absolute to current tab
			// Also remove style attribute from both current and target tab
		setTimeout(function(){
			contentBlocks[+targetTabNum].classList.add('position_static');
			contentBlocks[+currentTabNum].classList.remove('position_static');
			contentBlocks[+currentTabNum].classList.add('position_absolute');
            propsBlocks[+targetTabNum].classList.add('position_static');
            propsBlocks[+currentTabNum].classList.remove('position_static');
            propsBlocks[+currentTabNum].classList.add('position_absolute');

			contentBlocks[+targetTabNum].removeAttribute('style');
			contentBlocks[+currentTabNum].removeAttribute('style');
            propsBlocks[+targetTabNum].removeAttribute('style');
            propsBlocks[+currentTabNum].removeAttribute('style');
		}, 250);

		// Step 6 - set 'visible' class to target tab
		setTimeout(function(){
			contentBlocks[+targetTabNum].classList.add('visible');
            propsBlocks[+targetTabNum].classList.add('visible');
		}, 250);

		// Step 7 - set currentTabNum var equal to targetTabNum
		setTimeout(function(){
			currentTabNum = targetTabNum;
		}, 255);
	};

	function changeTabAdaptive(targetTabNum){

		// Check if user clicked on the tab which is already
		if(currentTabNum == targetTabNum){
			if(contentBlocks[+currentTabNum].classList.contains('visible')){
				// Step 1 - set current content block height to children height and after 10ms remove style height attribute
				contentBlocks[+currentTabNum].style.height = 
				contentBlocks[+currentTabNum].children[0].getBoundingClientRect().height +
				contentBlocks[+currentTabNum].children[1].getBoundingClientRect().height + 'px';

                propsBlocks[+currentTabNum].style.height =
                    propsBlocks[+currentTabNum].children[0].getBoundingClientRect().height +
                    propsBlocks[+currentTabNum].children[1].getBoundingClientRect().height + 'px';
				// Set 0 height to current content block
				setTimeout(function(){
					contentBlocks[+currentTabNum].style.height = 0;
                    propsBlocks[+currentTabNum].style.height = 0;
				}, 5);
				// Remove class 'visible', 'position_static', remove height style and add 'position_absolute'
				setTimeout(function(){
					contentBlocks[+currentTabNum].classList.remove('position_static');
					contentBlocks[+currentTabNum].classList.remove('visible');
					contentBlocks[+currentTabNum].classList.add('position_absolute');

                    propsBlocks[+currentTabNum].classList.remove('position_static');
                    propsBlocks[+currentTabNum].classList.remove('visible');
                    propsBlocks[+currentTabNum].classList.add('position_absolute');
					tabsBlocks[+currentTabNum].classList.remove('active');
				}, 400);

			} else{
				contentBlocks[+currentTabNum].style.height = 0;
				contentBlocks[+currentTabNum].classList.remove('position_absolute');
				contentBlocks[+currentTabNum].classList.add('position_static');
                propsBlocks[+currentTabNum].style.height = 0;
                propsBlocks[+currentTabNum].classList.remove('position_absolute');
                propsBlocks[+currentTabNum].classList.add('position_static');

				setTimeout(function(){
					contentBlocks[+currentTabNum].classList.add('visible');
					contentBlocks[+currentTabNum].style.height = 
					contentBlocks[+currentTabNum].children[0].getBoundingClientRect().height +
					contentBlocks[+currentTabNum].children[1].getBoundingClientRect().height + 'px';

                    propsBlocks[+currentTabNum].classList.add('visible');
                    propsBlocks[+currentTabNum].style.height =
                        propsBlocks[+currentTabNum].children[0].getBoundingClientRect().height +
                        propsBlocks[+currentTabNum].children[1].getBoundingClientRect().height + 'px';
					tabsBlocks[+currentTabNum].classList.add('active');
				}, 5);

			};
			
			return;
		};

		// Step 1 - set current content block height to children height and after 10ms remove style height attribute
		contentBlocks[+currentTabNum].style.height = 
		contentBlocks[+currentTabNum].children[0].getBoundingClientRect().height +
		contentBlocks[+currentTabNum].children[1].getBoundingClientRect().height + 'px';

        propsBlocks[+currentTabNum].style.height =
            propsBlocks[+currentTabNum].children[0].getBoundingClientRect().height +
            propsBlocks[+currentTabNum].children[1].getBoundingClientRect().height + 'px';

		setTimeout(function(){
			contentBlocks[+currentTabNum].style.height = 0;
            propsBlocks[+currentTabNum].style.height = 0;
		}, 5);

		// Step 2 - remove 'position_static' & 'visible' and set 'position_absolute' class to all content blocks
			// And set 'visible' & 'position_static' class to target block
		for(let i = 0; i < tabsBlocks.length; i++){
			contentBlocks[i].classList.remove('position_static');
			contentBlocks[i].classList.remove('visible');
            propsBlocks[i].classList.remove('position_static');
            propsBlocks[i].classList.remove('visible');
		};

		// *** Step 3 - set target tab children heights to variable before change target tab height value to prevent incorrect height value setTimeout
		var targetContentBlockHeight =
		contentBlocks[+targetTabNum].children[0].getBoundingClientRect().height +
		contentBlocks[+targetTabNum].children[1].getBoundingClientRect().height + 'px';

		// Step 4 - set height:0 to target tab
		contentBlocks[targetTabNum].style.height = 0;
		contentBlocks[targetTabNum].classList.add('visible');
		contentBlocks[targetTabNum].classList.remove('position_absolute');
		contentBlocks[targetTabNum].classList.add('position_static');
        propsBlocks[targetTabNum].style.height = 0;
        propsBlocks[targetTabNum].classList.add('visible');
        propsBlocks[targetTabNum].classList.remove('position_absolute');
        propsBlocks[targetTabNum].classList.add('position_static');

		// Step 5 - remove 'active' class from all tabs and set 'active' class to target tab
		for(let i = 0; i < tabsBlocks.length; i++){
			tabsBlocks[i].classList.remove('active');
		};
		tabsBlocks[+targetTabNum].classList.add('active');

		// Step 6 - set target content block height to children seight sum
		contentBlocks[+targetTabNum].style.height = targetContentBlockHeight;
        propsBlocks[+targetTabNum].style.height = targetContentBlockHeight;

		// Step 7 - set target content block height to auto
		setTimeout(function(){
			contentBlocks[+targetTabNum].style.height = 'auto';
            propsBlocks[+targetTabNum].style.height = 'auto';
		}, 200);

		// Step 8 - set currentTabNum var equal to targetTabNum
		setTimeout(function(){
			currentTabNum = targetTabNum;
		}, 255);

		// Step 9 - Scroll page to section headline
		window.smoothScroll = function(target) {
		    var scrollContainer = target;
		    do { //find scroll container
		        scrollContainer = scrollContainer.parentNode;
		        if (!scrollContainer) return;
		        scrollContainer.scrollTop += 1;
		    } while (scrollContainer.scrollTop == 0);
		    
		    var targetY = 0;
		    do { //find the top of target relatively to the container
		        if (target == scrollContainer) break;
		        targetY += target.offsetTop;
		    } while (target = target.offsetParent);
		    
		    scroll = function(c, a, b, i) {
		        i++; if (i > 30) return;
		        c.scrollTop = a + (b - a) / 30 * i;
		        setTimeout(function(){ scroll(c, a, b, i); }, 20);
		    }
		    // start scrolling
		    scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
		}

		smoothScroll(document.querySelector('main > section.doors_construction'));

	};

	// Check if such block is exists on current page
	if( document.querySelector('main > section.doors_construction') ){
		// Set click event listener to all tabs
		for( var i = 0; i < tabsBlocks.length; i++ ){
			tabsBlocks[i].addEventListener('click', function(){
				var this2 = this;

				if(timeout2){
					clearTimeout(timeout2);
				};
				
				var timeout2 = setTimeout(function(){
					changeTab(+this2.getAttribute('data-grid-tab'))
				}, 100);
			});
		};

	};

}());


// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Main visual carousel control

(function(){
	// Number which depends on what amount of frames is visible on current screen resolution. It's necessary to scroll carousel to certain amount of frames on each screen resolution
	window.mainVisualCarousel__visibleFrames = 3;

	// Check if such block exist on current page
	if( !document.querySelector('main .visual_carousel') ){
		return;
	};

	var framesParent = document.querySelector('main .visual_carousel .frames > ul'),
		framesList = document.querySelectorAll('main .visual_carousel .frames > ul > li'),
		switchBlock = document.querySelector('main .visual_carousel ul.switch'),
		arrLeft = document.querySelector('main .visual_carousel span.arr_left'),
		arrRight = document.querySelector('main .visual_carousel span.arr_right'),
		frameCounter = 0;
			
	// Set opacity and indent to all frames
	for(let i = 0; i < framesList.length; i++){
		framesList[i].style.left = i + '00%';

			framesList[i].classList.add('visible');
	};

	// Set certain amount of bullets inside switch block according to amount of slides
	var switchParentLisArray = [];
	// Create necessary amount of li's inside the array
	for(let i = 0; i < framesList.length + 1; i++){
		switchParentLisArray[i] = '<li data-frame="' + (i) + '"></li>';
	};
	// Convert array to string
	var switchParentLisString = switchParentLisArray.join('');

	// Assign string value to dotsParent innerHTML
	switchBlock.innerHTML = switchParentLisString;

	// Set click event listener to all switch bullets
	for(let i = 0; i < framesList.length; i++){
		switchBlock.children[i].addEventListener('click',function(){ 
			scrollSlider( this.getAttribute('data-frame') );
		});
	};

	// Declare indicator variable here beacuse otherwise we will get access to not existed last-child li because of changing switch parent block innerHTML
	var switchIndicator = document.querySelector('main .visual_carousel ul.switch > li:last-child');

	// Move framesParent and switchIndicator function
	function scroll(){
		framesParent.style.transform = 'translateX(-' + frameCounter + '00%)';
		switchIndicator.style.transform = 'translateX(' + frameCounter + '00%)';

		// Remove no-opacity class from all frames
		for(let i = 0; i < framesList.length; i++){
			framesList[i].classList.remove('no-opacity');
		};
		// Set no-opacity class to frames inside the viewport
		for(let j = 0; j < mainVisualCarousel__visibleFrames; j++){
			framesList[+frameCounter + +j].classList.add('no-opacity');
		};
	};

	function scrollSlider(whatToDo){

		// Change frameCounter value depending on what we want slider to do
		if(whatToDo == 'slideRight'){
			++frameCounter;
			// Set check if sliderCounter do not exceed acceptable values
			if(frameCounter > framesList.length - mainVisualCarousel__visibleFrames){
				frameCounter = framesList.length - mainVisualCarousel__visibleFrames;
			};
		} else if(whatToDo == 'slideLeft'){
			--frameCounter;
			// Set check if sliderCounter do not exceed acceptable values
			if(frameCounter < 0){
				frameCounter = 0;
			};
		} else if(!isNaN(whatToDo)){
			frameCounter = whatToDo;
			// Set check if sliderCounter do not exceed acceptable values
			if(frameCounter > framesList.length - mainVisualCarousel__visibleFrames){
				frameCounter = framesList.length - mainVisualCarousel__visibleFrames;
			} else if(frameCounter < 0){
				frameCounter = 0;
			};
		};

		// Check frameCounter value and run the slide function if needed to
		if(frameCounter == 0){
			scroll();
			// Set arrows style
			arrLeft.classList.add('inactive');
			arrRight.classList.remove('inactive');
		} else if(frameCounter == framesList.length - mainVisualCarousel__visibleFrames){
			scroll();
			// Set arrows style
			arrLeft.classList.remove('inactive');
			arrRight.classList.add('inactive');
		} else{
			scroll()
			// Set arrows style
			arrLeft.classList.remove('inactive');
			arrRight.classList.remove('inactive');
		};
	};

	arrLeft.addEventListener('click', function(){scrollSlider('slideLeft')}); 
	arrRight.addEventListener('click', function(){scrollSlider('slideRight')});

	// ------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------
	// ------------------------------------------------------------------------------------------------
	// Set swipe processor
	var hammertime1 = new Hammer(document.querySelector('main .visual_carousel'), {
		enable: true,
		recognizers: [
			[Hammer.Swipe, { direction: Hammer.DIRECTION_HORIZONTAL }]
		]
	});

	hammertime1.on('swipeleft', function(){scrollSlider('slideRight')});
	hammertime1.on('swiperight', function(){scrollSlider('slideLeft')});


}());

// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Popular models slider control

(function(){
	// Number which depends on what amount of frames is visible on current screen resolution. It's necessary to scroll carousel to certain amount of frames on each screen resolution
	window.popularModelsSlider__visibleFrames = 4;

	// Check if such block exist on current page
	if( !document.querySelector('main > section.popular_models') ){
		return;
	};

	var framesList = document.querySelectorAll('main > section.popular_models > .frames > ul > li'),
		framesParent = document.querySelector('main > section.popular_models > .frames > ul'),
		arrLeft = document.querySelector('main > section.popular_models > span.arr_left'),
		arrRight = document.querySelector('main > section.popular_models > span.arr_right'),
		frameCounter = 0;

		// Set left indent to all frames
		for(let i = 0; i < framesList.length; i++){
			framesList[i].style.left = i + '00%';
		};

		// Move framesParent function
		function scroll(){
			framesParent.style.transform = 'translateX(-' + frameCounter + '00%)';
		};

		function scrollSlider(whatToDo){

			// Change frameCounter value depending on what we want slider to do
			if(whatToDo == 'slideRight'){
				++frameCounter;
				// Set check if sliderCounter do not exceed acceptable values
				if(frameCounter > framesList.length - popularModelsSlider__visibleFrames){
					frameCounter = framesList.length - popularModelsSlider__visibleFrames;
				};
			} else if(whatToDo == 'slideLeft'){
				--frameCounter;
				// Set check if sliderCounter do not exceed acceptable values
				if(frameCounter < 0){
					frameCounter = 0;
				};
			};

			// Check frameCounter value and run the slide function if needed to
			if(frameCounter == 0){
				scroll();
				// Set arrows style
				arrLeft.classList.add('inactive');
				arrRight.classList.remove('inactive');
			} else if(frameCounter == framesList.length - popularModelsSlider__visibleFrames){
				scroll();
				// Set arrows style
				arrLeft.classList.remove('inactive');
				arrRight.classList.add('inactive');
			} else{
				scroll()
				// Set arrows style
				arrLeft.classList.remove('inactive');
				arrRight.classList.remove('inactive');
			};
		};

		arrLeft.addEventListener('click', function(){scrollSlider('slideLeft')}); 
		arrRight.addEventListener('click', function(){scrollSlider('slideRight')});

		// -----------------------------------------------------------------------------------------
		// -----------------------------------------------------------------------------------------
		// -----------------------------------------------------------------------------------------
		// -----------------------------------------------------------------------------------------
		// -----------------------------------------------------------------------------------------
		// Set swipe processor
		window.hammertime_popularModels = new Hammer(document.querySelector('main > section.popular_models'), {
			enable: true,
			recognizers: [
				[Hammer.Swipe, { direction: Hammer.DIRECTION_HORIZONTAL }]
			]
		});

		hammertime_popularModels.on('swipeleft', function(){scrollSlider('slideRight')});
		hammertime_popularModels.on('swiperight', function(){scrollSlider('slideLeft')});
	
})();


// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Clear text inputs and textareas on focus
(function(){
	// Select all inputs which we want to clear on focus
	var allInputs = Array.prototype.slice.call(document.querySelectorAll('input[type="text"]')).concat(Array.prototype.slice.call(document.querySelectorAll('input[type="password"]')));
	for(let i = 0; i < allInputs.length; i++){
		// Set data-value attribute to all inputs to save there inputs values
		allInputs[i].setAttribute('data-value', allInputs[i].value);

		// Add placeholder text color class
		allInputs[i].classList.add('placeholder_color');

		// Set type=text to all password inputs (don't worry, we will change it back on user's click)
		if(allInputs[i].dataset.value == 'Password'){
			allInputs[i].type = 'text';
			allInputs[i].value = allInputs[i].dataset.value;
		};

		// Set the focus handler for all inputs
		allInputs[i].addEventListener('focus', function(){
			// Set type=password back to password fields
			if(this.dataset.value == 'Password'){
				this.type = 'password';
			};
			
			// Clear 'placeholder' on click
			if(this.value == this.dataset.value){
				this.value = '';
				this.classList.remove('placeholder_color');
			};
		});
		allInputs[i].addEventListener('blur',function(){

			// Return type=text to password fields if user did not set the password
			if(this.dataset.value == 'Password' && this.value == ''){
				this.type = 'text';
			};

			// Set 'placeholder' back if user did not fill the input
			if(this.value == ''){
				this.value = this.dataset.value;
				this.classList.add('placeholder_color');
			};
		});
	};

	// Select all textareas which we want to clear on focus
	var allTextareas = document.querySelectorAll('textarea');

	for(let i = 0; i < allTextareas.length; i++){
		// Set data-value attribute to all textareas to save there textarea values
		allTextareas[i].setAttribute('data-value', allTextareas[i].value);

		// Add placeholder text color class
		allTextareas[i].classList.add('placeholder_color');

		// Set the focus handler for all textareas
		allTextareas[i].addEventListener('focus', function(){
			
			// Clear textarea content on click
			if(this.value == this.dataset.value){
				this.value = '';
				this.classList.remove('placeholder_color');
			};
		});
		allTextareas[i].addEventListener('blur', function(){
			// Set 'placeholder' back if user did not fill the textarea
			if(this.value == ''){
				this.value = this.dataset.value;
				this.classList.add('placeholder_color');
			};
		});
	};
}());


// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Catalog list filters block control on adaptive version (on <= 1000px screens)
(function(){

	// Check if such block exist on the page
	if( !document.querySelector('body > main.content > section.catalog_list') ){
		return;
	};

	var openLabel = document.querySelector('body > main.content > section.catalog_list > .filters .open_label'),
		adaptiveCloseBut = document.querySelector('body > main.content > section.catalog_list .filters span.close_but'),
		formBlock = document.querySelector('body > main.content > section.catalog_list > .filters form'),
		formBlockAllChildrenHeight = 0,
		removeHeightTimeout;

		console.log(adaptiveCloseBut);

	// Sum up all form children blocks
	/*for(let i = 0; i < formBlock.children.length; i++){
		formBlockAllChildrenHeight += formBlock.children[i].getBoundingClientRect().height + 8;
	};*/

	// Check check whether such a block is on the page
	if( document.querySelector('body > main.content > section.catalog_list') ){

		function openHideFilters(){
			// Check whether form block is already opened
			if(formBlock.classList.contains('opened')){
				formBlock.style.height = 0 + 'px';
				formBlock.classList.remove('opened');
				openLabel.classList.remove('opened');

				removeHeightTimeout = setTimeout(function(){
					formBlock.style.height = '';
				}, 400);
			} else{
				clearTimeout(removeHeightTimeout);

				setTimeout(function(){
					formBlock.style.height = formBlockAllChildrenHeight + 'px';
					formBlock.classList.add('opened');
					openLabel.classList.add('opened');
				}, 50);
			};
		};

		openLabel.addEventListener('click', function(){
			openHideFilters()
		});

		adaptiveCloseBut.addEventListener('click', function(){
			openHideFilters()
		});
	};

}());

// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// About photos slider control
(function(){
	// Check if such block available on the page
	if( !document.querySelector('main > section.about_company > .photos_slider > ul') ){
		return;
	};

	var frames = document.querySelectorAll('main > section.about_company > .photos_slider > ul > li'),
		framesText = document.querySelectorAll('main > section.about_company > .description > ul.text_slider > li'),
		framesTextParent = document.querySelector('main > section.about_company > .description > ul.text_slider'),
		switchBlock = document.querySelector('main > section.about_company > .description > ul.switch'),
		frameCounter = 0;

	// Set certain amount of bullets inside switch block according to amount of slides
	var switchParentLisArray = [];
	// Create necessary amount of li's inside the array
	for(let i = 0; i < frames.length + 1; i++){
		switchParentLisArray[i] = '<li data-frame="' + (i) + '"></li>';
	};
	// Convert array to string
	var switchParentLisString = switchParentLisArray.join('');

	// Assign string value to dotsParent innerHTML
	switchBlock.innerHTML = switchParentLisString;

	// Blue bullet which indicates slider frame position
	var indicator = document.querySelector('main > section.about_company > .description > ul.switch > li:last-child');

	// Set first frame active and move indicator to first position
	frames[0].classList.add('visible');
	indicator.style.transform = 'translateX(' + frameCounter + '00%)';

	// Set text patent height to selected frames children height sum
	var textFrameChildrenHeightSum = 0;
		// Sum up all selected text frame children height
	for( var i = 0; i < framesText[frameCounter].children.length; i++){
		textFrameChildrenHeightSum += framesText[frameCounter].children[i].getBoundingClientRect().height;
	};
		// Set selected text frame children height sum to text frames parent
	setTimeout(function(){
		framesTextParent.style.height = textFrameChildrenHeightSum + 'px';
	}, 200);

	function slideFrames(whatToDo){
		// Change frames counter according to 'whatToDo' value
		if(whatToDo == 'slideLeft'){
			++frameCounter;
		} else if(whatToDo == 'slideRight'){
			--frameCounter;
		};

		// If whatToDo is number than set framesCounter value equal to this number
		if(!isNaN(whatToDo)){
			frameCounter = whatToDo;
		};

		if(frameCounter < 0){
			frameCounter = 0;
		} else if(frameCounter > frames.length - 1){
			frameCounter = frames.length - 1;
		};

		// Set selected frame visible
		frames[frameCounter].style.zIndex = 3;
		frames[frameCounter].classList.add('visible');

		setTimeout(function(){
			// Clear z-index value from all frames and 'visible' class from all frames except current
			for( var i = 0; i < frames.length; i++){
				frames[i].setAttribute('style', '');

				if( i == frameCounter){
					continue
				} else{
					frames[i].classList.remove('visible');
				};
			};
		}, 400);

		// Remove visible class from all text frames
		for( var i = 0; i < frames.length; i++){
			framesText[i].classList.remove('visible');
		};
		framesText[frameCounter].classList.add('visible');

		// Set text patent height to selected frames children height sum
		var textFrameChildrenHeightSum = 0;
			// Sum up all selected text frame children height
		for( var i = 0; i < framesText[frameCounter].children.length; i++){
			textFrameChildrenHeightSum += framesText[frameCounter].children[i].getBoundingClientRect().height;
		};
			// Set selected text frame children height sum to text frames parent
		setTimeout(function(){
			framesTextParent.style.height = textFrameChildrenHeightSum + 'px';
		}, 200);


		// Move indicator to position which is corresponds to selected frame
		indicator.style.transform = 'translateX(' + frameCounter + '00%)';

	};

	// Add click event listeners to all bullets in switch block
	for( var i = 0; i < frames.length; i++ ){
		switchBlock.children[i].addEventListener('click', function(){
			slideFrames(+this.getAttribute('data-frame'));
		});
	};

	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// Set swipe processor
	var hammertime3 = new Hammer(document.querySelector('main > section.about_company'), {
		enable: true,
		recognizers: [
			[Hammer.Swipe, { direction: Hammer.DIRECTION_HORIZONTAL }]
		]
	});

	hammertime3.on('swipeleft', function(){slideFrames('slideLeft')});
	hammertime3.on('swiperight', function(){slideFrames('slideRight')});

}());


// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Adaptive regular menu control
(function(){
	var menuBlocks = document.querySelectorAll('main div[data-cnt-menu="1"]'),
		menuHeadlines = document.querySelectorAll('main div[data-cnt-menu="1"] > .headline');

	// Check if such block exist on the page
	if( document.querySelector('main div[data-cnt-menu="1"]') ){
		// Add event listeners to all headlines
		for( var i = 0; i < menuBlocks.length; i++ ){
			menuHeadlines[i].addEventListener('click', function(){
				var parent = this.parentNode;

				if(window.innerWidth <= 1000){
					if(!this.parentNode.classList.contains('opened')){
						parent.classList.add('opened');
						parent.style.height = parent.children[0].getBoundingClientRect().height + parent.children[1].getBoundingClientRect().height + 'px';
					} else{
						parent.classList.remove('opened');
						parent.style.height = parent.children[0].getBoundingClientRect().height + 'px';

					};
				};
			});
		};
	};
}());


// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Product details upholstery slider control
(function(){

	// Check if such block exist on the page
	if( !document.querySelector('main > section.product_details') ){
		return;
	};

	var tab1 = document.querySelectorAll('main > .product_details > .details .upholstery_material_select .tab_but')[0],
		tab2 = document.querySelectorAll('main > .product_details > .details .upholstery_material_select .tab_but')[1],
		framesParent1 = document.querySelector('main > .product_details > .details .upholstery_material_select .inside_materials > ul'),
		framesParent2 = document.querySelector('main > .product_details > .details .upholstery_material_select .outside_materials > ul'),
		framesList1 = document.querySelectorAll('main > .product_details > .details .upholstery_material_select .inside_materials > ul > li'),
		framesList2 = document.querySelectorAll('main > .product_details > .details .upholstery_material_select .outside_materials > ul > li'),
		arrLeft = document.querySelector('main > .product_details > .details .upholstery_material_select > .arr_but.left'),
		arrRight = document.querySelector('main > .product_details > .details .upholstery_material_select > .arr_but.right'),
		frameCount1 = 0,
		frameCount2 = 0,
		activeTab = 1;
	window.upholsteryMaterialSlider__visibleSlidesNum = 11;

	// Set position indent for all frames
	for( var i = 0; i < framesList1.length; i++){
		framesList1[i].style.left = i + 1 + '00%';
	};
	for( var i = 0; i < framesList2.length; i++){
		framesList2[i].style.left = i + 1 + '00%';
	};

	// Set arrows style according to frames amount in first slider
	if(framesList1.length > upholsteryMaterialSlider__visibleSlidesNum){
		arrLeft.classList.add('inactive');
		arrRight.classList.remove('inactive');
	} else{
		arrLeft.classList.add('inactive');
		arrRight.classList.add('inactive');
	};

	function scrollSlider(whatToDo){
		// Do nothing if screen width less than 740px
		if(window.innerWidth <= 740){
			return;
		};
		
		// Select which list to scroll (first or second one)
		if(tab1.classList.contains('active')){
			var framesParent = framesParent1,
				framesList = framesList1,
				frameCount = frameCount1;
		} 
		else{
			var framesParent = framesParent2,
				framesList = framesList2,
				frameCount = frameCount2;
		};

		// Step 1 - change frameCount1 variable according to whatToDo value
		if(whatToDo == 'scrollRight'){
			frameCount += 3;
		} else if(whatToDo == 'scrollLeft'){
			frameCount -= 3;
		};

		// Ste 2 - check if frameCount1 not exceed allowed values
		if(frameCount < 0){
			frameCount = 0;
		} else if(frameCount > framesList.length - upholsteryMaterialSlider__visibleSlidesNum){
			frameCount = framesList.length - upholsteryMaterialSlider__visibleSlidesNum;
		};
			// Set frame count to - 1 if actual frames amount is less than maximum visible frames amount
		if(framesList.length < upholsteryMaterialSlider__visibleSlidesNum){
			frameCount = -1;
		};

		// Step 3 - Shift frams parent to certain amount of % accroding to frameCount1 value
		framesParent.style.transform = 'translateX(-' + frameCount + '00%)';

		// Step 4 - set arrows style according to list scroll position
		if( frameCount == 0 ){
			arrLeft.classList.add('inactive');
			arrRight.classList.remove('inactive');
		} else if( frameCount == framesList.length - upholsteryMaterialSlider__visibleSlidesNum ){
			arrLeft.classList.remove('inactive');
			arrRight.classList.add('inactive');
		} else if( frameCount == -1 ){
			arrLeft.classList.add('inactive');
			arrRight.classList.add('inactive');
		} else{
			arrLeft.classList.remove('inactive');
			arrRight.classList.remove('inactive');
		};

		// Step 5 - set outside frameCount var equal to inside frameCount var
		if(tab1.classList.contains('active')){
			frameCount1 = frameCount;
		} 
		else{
			frameCount2 = frameCount;
		};
	};

	function tabChange(){
		// Step 1 - Set variables depending on which tab is currenctly active
		if( activeTab == 1 ){
			var tabCurrent = tab1,
				tabTarget = tab2,
				framesParentCurrent = framesParent1,
				framesParentTarget = framesParent2,
				framesGlobalParentCurrent = document.querySelector('main > .product_details > .details .upholstery_material_select .inside_materials'),
				framesGlobalParentTarget = document.querySelector('main > .product_details > .details .upholstery_material_select .outside_materials');
		} else{
			var tabCurrent = tab2,
				tabTarget = tab1,
				framesParentCurrent = framesParent2,
				framesParentTarget = framesParent1,
				framesGlobalParentCurrent = document.querySelector('main > .product_details > .details .upholstery_material_select .outside_materials'),
				framesGlobalParentTarget = document.querySelector('main > .product_details > .details .upholstery_material_select .inside_materials');
		};

		// Step 2 - Set 'invisible' and 'disabled' classes for current frames global parent
		framesGlobalParentCurrent.classList.add('invisible');
		setTimeout(function(){
			framesGlobalParentCurrent.classList.add('disabled');
		}, 200);

		// Set current slider invisible
		setTimeout(function(){
			framesGlobalParentTarget.classList.remove('disabled');
		}, 200);
		setTimeout(function(){
			framesGlobalParentTarget.classList.remove('invisible');
		}, 210);

		// Step 3 - Set all sliders scroll position to 1st frame and set slider position variables to 0
		setTimeout(function(){
			framesParentCurrent.style.transform = 'translateX(0)';
			framesParentTarget.style.transform = 'translateX(0)';
			frameCount1 = 0;
			frameCount2 = 0;
			scrollSlider();
		}, 200);

		// Step 4 - Set classes to tabs
		tabCurrent.classList.remove('active');
		tabTarget.classList.add('active');

		// Step 5 - Set active tab variable to opposite value
		if(activeTab == 1){
			activeTab = 2;
		} else{
			activeTab = 1;
		};
	};

	arrLeft.addEventListener('click', function(){ scrollSlider('scrollLeft') });
	arrRight.addEventListener('click', function(){ scrollSlider('scrollRight') });

	tab1.addEventListener('click', function(){
		if( this.classList.contains('active') ){
			return;
		} else{
			tabChange();
		};
	});
	tab2.addEventListener('click', function(){
		if( this.classList.contains('active') ){
			return;
		} else{
			tabChange();
		};
	});



	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// Set swipe processor
	var hammertime_upholstery = new Hammer( document.querySelector('main > .product_details > .details .upholstery_material_select'), {
		enable: true,
		recognizers: [
			[Hammer.Swipe, { direction: Hammer.DIRECTION_HORIZONTAL }]
		]
	});

	hammertime_upholstery.on('swipeleft', function(){scrollSlider('scrollRight')});
	hammertime_upholstery.on('swiperight', function(){scrollSlider('scrollLeft')});

}());


// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Product details upholstery color select slider control
(function(){
	// Check if such block exist on the page
	if( !document.querySelector('main > .product_details') ){
		return;
	};
	var framesParent = document.querySelector('main > .product_details > .details > .upholstery_color_select > ul'),
		framesList = document.querySelectorAll('main > .product_details > .details > .upholstery_color_select > ul > li'),
		arrLeft = document.querySelector('main > .product_details > .details > .upholstery_color_select > .arr_but.left'),
		arrRight = document.querySelector('main > .product_details > .details > .upholstery_color_select > .arr_but.right'),
		frameCount = 0;
	window.upholsteryColorSlider__visibleSlidesNum = 9;


	// Set position indent for all frames
	for( var i = 0; i < framesList.length; i++){
		framesList[i].style.left = i + 1 + '00%';
	};

	// Set arrows style according to frames amount in first slider
	if(framesList.length > upholsteryColorSlider__visibleSlidesNum){
		arrLeft.classList.add('inactive');
		arrRight.classList.remove('inactive');
	} else{
		arrLeft.classList.add('inactive');
		arrRight.classList.add('inactive');
	};

	
	function scrollSlider(whatToDo){
		// Do nothing if screen width less than 740px
		if(window.innerWidth <= 740){
			return;
		};

		// Step 1 - change frameCount1 variable according to whatToDo value
		if(whatToDo == 'scrollRight'){
			frameCount += 3;
		} else if(whatToDo == 'scrollLeft'){
			frameCount -= 3;
		};

		// Ste 2 - check if frameCount1 not exceed allowed values
		if(frameCount < 0){
			frameCount = 0;
		} else if(frameCount > framesList.length - upholsteryColorSlider__visibleSlidesNum){
			frameCount = framesList.length - upholsteryColorSlider__visibleSlidesNum;
		};
			// Set frame count to - 1 if actual frames amount is less than maximum visible frames amount
		if(framesList.length < upholsteryColorSlider__visibleSlidesNum){
			frameCount = -1;
		};

		// Step 3 - Shift frames parent to certain amount of % accroding to frameCount1 value
		framesParent.style.transform = 'translateX(-' + frameCount + '00%)';

		// Step 4 - set arrows style according to list scroll position
		if( frameCount == 0 ){
			arrLeft.classList.add('inactive');
			arrRight.classList.remove('inactive');
		} else if( frameCount == framesList.length - upholsteryColorSlider__visibleSlidesNum ){
			arrLeft.classList.remove('inactive');
			arrRight.classList.add('inactive');
		} else if( frameCount == -1 ){
			arrLeft.classList.add('inactive');
			arrRight.classList.add('inactive');
		} else{
			arrLeft.classList.remove('inactive');
			arrRight.classList.remove('inactive');
		};

	};

	arrLeft.addEventListener('click', function(){ scrollSlider('scrollLeft') });
	arrRight.addEventListener('click', function(){ scrollSlider('scrollRight') });

	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// Set swipe processor
	var hammertime_upholstery_color = new Hammer( document.querySelector('main > .product_details > .details .upholstery_color_select'), {
		enable: true,
		recognizers: [
			[Hammer.Swipe, { direction: Hammer.DIRECTION_HORIZONTAL }]
		]
	});

	hammertime_upholstery_color.on('swipeleft', function(){scrollSlider('scrollRight')});
	hammertime_upholstery_color.on('swiperight', function(){scrollSlider('scrollLeft')});

}());



// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Product details door swipe control
(function(){
	
	// Check if such block exist on the page
	if( !document.querySelector('main > .product_details') ){
		return;
	};

	var demonstrationBlock = document.querySelector('main > section.product_details > .demonstration'),
		doorFront = document.querySelector('main > section.product_details > .demonstration > .door > img.front_side'),
		doorBack = document.querySelector('main > section.product_details > .demonstration > .door > img.back_side'),
		switchBut = document.querySelector('main > section.product_details > .demonstration > .door > span.switch_side');

	function doorSwipe(){
		// Step 1 - Check which door side is visible at the moment and assign variables
		if( doorFront.classList.contains('visible') ){
			var currentSide = doorFront,
				targetSide = doorBack;
		} else{
			var currentSide = doorBack,
				targetSide = doorFront;
		};

		// Step 2 - set button class to opposite
		if( switchBut.classList.contains('front') ){
			switchBut.classList.remove('front');
			switchBut.classList.add('back');
			demonstrationBlock.classList.add('outside');
		} else{
			switchBut.classList.remove('back');
			switchBut.classList.add('front');
			demonstrationBlock.classList.remove('outside');
		};

		// Step 3 - set target side z-index and 'visible' class
		targetSide.classList.add('visible');
		targetSide.style.zIndex = 3;

		// Step 4 - remove 'visible' class from current side
			// And remove z-index from target side
		setTimeout(function(){
			currentSide.classList.remove('visible');
		}, 200);

		setTimeout(function(){
			targetSide.setAttribute('style', '');
		}, 400);
	};

	switchBut.addEventListener('click', function(){
		setTimeout(function(){
			doorSwipe();
		}, 50);
	});

}());



// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Product details door construction tables control
(function(){
	// Check if such block exist on the page
	if( !document.querySelector('main > section.doors_details_table') ){
		return;
	};

	var headlines = document.querySelectorAll('main > section.doors_details_table > .column > .headline'),
		tableBlocks = document.querySelectorAll('main > section.doors_details_table > .column > ul'),
		currentTab = 0,
		targetTab;

	// Set number marks to all titles and tables
	for( let i = 0; i < headlines.length; i++ ){
		headlines[i].setAttribute('data-tab', i);
		tableBlocks[i].setAttribute('data-tab', i);
	};

	function openTable(){
		// Check if window width is not exceed acceptable value
		if(window.innerWidth > 740){
			return;
		};

		// Check whether target tab is equal to current tab
		if(currentTab == targetTab){
			if( tableBlocks[targetTab].classList.contains('visible') ){

				// Step 1 - set height to current table block to animate in in the next step
				tableBlocks[currentTab].style.height = tableBlocks[currentTab].getBoundingClientRect().height + 'px';

				// Step 2 - Remove 'visible' class from current tab and set current table height to 0
				setTimeout(function(){
					headlines[currentTab].classList.remove('visible');
					tableBlocks[currentTab].style.height = 0;
					tableBlocks[currentTab].classList.remove('visible');
				}, 20);

				// Step 3 - Remove style height attribute from target table
				setTimeout(function(){
					tableBlocks[targetTab].removeAttribute('style');
				}, 200);

			} else{
				// Step 1 - Calculate children nodes height of the target table block and set heights sum to parent block
				var targetTableHeightSum = 0
				for( let i = 0; i < tableBlocks[targetTab].children.length; i++ ){
					targetTableHeightSum += tableBlocks[targetTab].children[i].getBoundingClientRect().height;

					// On the last cycle iteration set targetTableHeightSum value to target table block height style
						// And add 'visible' class to target table block
					if(i == tableBlocks[targetTab].children.length - 1){
						tableBlocks[targetTab].style.height = targetTableHeightSum + 'px';
						tableBlocks[targetTab].classList.add('visible');
					};
				};	
				
				headlines[currentTab].classList.add('visible');
				tableBlocks[currentTab].classList.add('visible');

				// Step 2 - Remove style height attribute from target table
				setTimeout(function(){
					tableBlocks[targetTab].removeAttribute('style');
				}, 200);
			};

			return;
		};

		// Step 1 - set height to current table block to animate in in the next step
		tableBlocks[currentTab].style.height = tableBlocks[currentTab].getBoundingClientRect().height + 'px';

		// Step 2 - remove 'visible' class from current tab and set current table height to 0
		setTimeout(function(){
			headlines[currentTab].classList.remove('visible');
			tableBlocks[currentTab].style.height = 0;
			tableBlocks[currentTab].classList.remove('visible');
		}, 20);

		// Step 3 calculate children nodes height of the target table block and set heights sum to parent block
		var targetTableHeightSum = 0
		for( let i = 0; i < tableBlocks[targetTab].children.length; i++ ){
			targetTableHeightSum += tableBlocks[targetTab].children[i].getBoundingClientRect().height;

			// On the last cycle iteration set targetTableHeightSum value to target table block height style
				// And add 'visible' class to target table block
			if(i == tableBlocks[targetTab].children.length - 1){
				tableBlocks[targetTab].style.height = targetTableHeightSum + 'px';
				tableBlocks[targetTab].classList.add('visible');
			};
		};

		// Step 4 - Add 'visible' class to target headline and remove style height attribute from target table
		setTimeout(function(){
			if(currentTab != targetTab){
				headlines[targetTab].classList.add('visible');
			};
			tableBlocks[targetTab].removeAttribute('style');
			tableBlocks[currentTab].removeAttribute('style');
		}, 200);

		// Step 5 - Set currentTab var value to targetTab
		setTimeout(function(){
			currentTab = targetTab;
		}, 200);

		// Step 6 - Scroll page to section headline
		window.smoothScroll = function(target) {
		    var scrollContainer = target;
		    do { //find scroll container
		        scrollContainer = scrollContainer.parentNode;
		        if (!scrollContainer) return;
		        scrollContainer.scrollTop += 1;
		    } while (scrollContainer.scrollTop == 0);
		    
		    var targetY = 0;
		    do { //find the top of target relatively to the container
		        if (target == scrollContainer) break;
		        targetY += target.offsetTop;
		    } while (target = target.offsetParent);
		    
		    scroll = function(c, a, b, i) {
		        i++; if (i > 30) return;
		        c.scrollTop = a + (b - a) / 30 * i;
		        setTimeout(function(){ scroll(c, a, b, i); }, 20);
		    }
		    // start scrolling
		    scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
		}

		smoothScroll(document.querySelector('main > section.doors_details_table'));

	};

	// Set event listeners to all headlines
	for( let i = 0; i < headlines.length; i++ ){
		headlines[i].addEventListener('click', function(){
			targetTab = +this.getAttribute('data-tab');
			openTable();
		});
	};

}());


// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Popups control
(function(){
	// Check if such block exist on the page
	if( !document.querySelector('body > .popups') ){
		return;
	};

	var popupParent = document.querySelector('body > .popups'),
		popupWindows = document.querySelectorAll('body > .popups > .window'),
		popupCallMaster = document.querySelector('body > .popups > .window.call_master'),

		popupOrderDoor_standart = document.querySelector('body > .popups > .window.order_door__standart'),
		popupOrderDoor_termo = document.querySelector('body > .popups > .window.order_door__termo'),
		popupOrderDoor_euro3k = document.querySelector('body > .popups > .window.order_door__euro3k'),
		popupOrderDoor_eurotermo3k = document.querySelector('body > .popups > .window.order_door__eurotermo3k'),

		popupOrderCall = document.querySelector('body > .popups > .window.order_call'),

		popupDoorCut_standart = document.querySelector('body > .popups > .window.door_cut__standart'),
		popupDoorCut_termo = document.querySelector('body > .popups > .window.door_cut__termo'),
		popupDoorCut_euro3k = document.querySelector('body > .popups > .window.door_cut__euro3k'),
		popupDoorCut_eurotermo3k = document.querySelector('body > .popups > .window.door_cut__eurotermo3k'),

		popupLocksCatalog = document.querySelector('body > .popups > .window.locks_catalog'),

		// All open popup buttons
		showPopupButtons = Array.prototype.slice.call(
			document.querySelectorAll('*[data-popup="order_master"]'))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="orderDoor_standart"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="orderDoor_termo"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="orderDoor_euro3k"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="orderDoor_eurotermo3k"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="order_call"]')))

			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="doorCut_standart"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="doorCut_termo"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="doorCut_euro3k"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="doorCut_eurotermo3k"]')))

			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="close_and__orderDoor_standart"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="close_and__orderDoor_termo"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="close_and__orderDoor_euro3k"]')))
			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="close_and__orderDoor_eurotermo3k"]')))

			.concat(Array.prototype.slice.call(document.querySelectorAll('*[data-popup="locks_catalog"]'))
		),
		closePopupButtons = document.querySelectorAll('*[data-popup="close"]');

	// Open popup function
	function openPopup(whatToOpen){
		var windowShowDelay = 100;

		if(whatToOpen == 'order_master'){
			// Open Order Master popup
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupCallMaster.classList.add('visible');
			}, windowShowDelay);

		} else if(whatToOpen == 'orderDoor_standart'){
			// Open Order Door popup
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupOrderDoor_standart.classList.add('visible');
			}, windowShowDelay);

		} else if(whatToOpen == 'orderDoor_termo'){
			// Open Order Door popup
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupOrderDoor_termo.classList.add('visible');
			}, windowShowDelay);

		} else if(whatToOpen == 'orderDoor_euro3k'){
			// Open Order Door popup
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupOrderDoor_euro3k.classList.add('visible');
			}, windowShowDelay);

		} else if(whatToOpen == 'orderDoor_eurotermo3k'){
			// Open Order Door popup
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupOrderDoor_eurotermo3k.classList.add('visible');
			}, windowShowDelay);

		} else if(whatToOpen == 'order_call'){
			// Open Order Call popup
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupOrderCall.classList.add('visible');
			}, windowShowDelay);

		} else if(whatToOpen == 'doorCut_standart'){
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupDoorCut_standart.classList.add('visible');
			}, windowShowDelay);

			// Run scheme numbers highlight control function
			doorCutScheme_control('doorCut_standart');

		} else if(whatToOpen == 'doorCut_termo'){
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupDoorCut_termo.classList.add('visible');
			}, windowShowDelay);

			// Run scheme numbers highlight control function
			doorCutScheme_control('doorCut_termo');
			
		} else if(whatToOpen == 'doorCut_euro3k'){
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupDoorCut_euro3k.classList.add('visible');
			}, windowShowDelay);

			// Run scheme numbers highlight control function
			doorCutScheme_control('doorCut_euro3k');
			
		} else if(whatToOpen == 'doorCut_eurotermo3k'){
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupDoorCut_eurotermo3k.classList.add('visible');
			}, windowShowDelay);

			// Run scheme numbers highlight control function
			doorCutScheme_control('doorCut_eurotermo3k');
			


		} else if(whatToOpen == 'locks_catalog'){
			popupParent.classList.add('visible');
			setTimeout(function(){
				popupLocksCatalog.classList.add('visible');
			}, windowShowDelay);
			


		} else if(whatToOpen == 'close_and__orderDoor_standart'){
			closePopup();
			setTimeout(function(){
				openPopup('orderDoor_standart');
			}, 250)
		} else if(whatToOpen == 'close_and__orderDoor_termo'){
			closePopup();
			setTimeout(function(){
				openPopup('orderDoor_termo');
			}, 250)
		} else if(whatToOpen == 'close_and__orderDoor_euro3k'){
			closePopup();
			setTimeout(function(){
				openPopup('orderDoor_euro3k');
			}, 250)
		} else if(whatToOpen == 'close_and__orderDoor_eurotermo3k'){
			closePopup();
			setTimeout(function(){
				openPopup('orderDoor_eurotermo3k');
			}, 250)
		};

	};

	// Close popup function
	function closePopup(){
		var whatToClose = Array.prototype.slice.call(
			document.querySelectorAll('body > .popups'))
			.concat(Array.prototype.slice.call(document.querySelectorAll('body > .popups > .window'))
		);

		for(let i = 0; i < whatToClose.length; i++){
			whatToClose[i].classList.remove('visible');
		};
	};

	// Add click eventlisteners to all open buttons
	for(let i = 0; i < showPopupButtons.length; i++){
		showPopupButtons[i].addEventListener('click', function(){
			openPopup( this.getAttribute('data-popup') );
		});
	};

	// Add click eventListener to all close buttons
	for(let i = 0; i < closePopupButtons.length; i++){
		closePopupButtons[i].addEventListener('click', function(){
			closePopup();
		});
	};

	// Door cut schemes control
	function doorCutScheme_control(parentBlock){
		// Set all needed variables
		if(parentBlock == 'doorCut_standart'){
			var schemeParent = document.querySelector('body > .popups > .window.door_cut__standart ul.active_number'),
				numberDots = document.querySelectorAll('body > .popups > .window.door_cut__standart ul.active_number > li'),
				descriptionStrings = document.querySelectorAll('body > .popups > .window.door_cut__standart ul.description_strings_list > li');

		} else if(parentBlock == 'doorCut_termo'){
			var schemeParent = document.querySelector('body > .popups > .window.door_cut__termo ul.active_number'),
				numberDots = document.querySelectorAll('body > .popups > .window.door_cut__termo ul.active_number > li'),
				descriptionStrings = document.querySelectorAll('body > .popups > .window.door_cut__termo ul.description_strings_list > li');

		} else if(parentBlock == 'doorCut_euro3k'){
			var schemeParent = document.querySelector('body > .popups > .window.door_cut__euro3k ul.active_number'),
				numberDots = document.querySelectorAll('body > .popups > .window.door_cut__euro3k ul.active_number > li'),
				descriptionStrings = document.querySelectorAll('body > .popups > .window.door_cut__euro3k ul.description_strings_list > li');

		} else if(parentBlock == 'doorCut_eurotermo3k'){
			var schemeParent = document.querySelector('body > .popups > .window.door_cut__eurotermo3k ul.active_number'),
				numberDots = document.querySelectorAll('body > .popups > .window.door_cut__eurotermo3k ul.active_number > li'),
				descriptionStrings = document.querySelectorAll('body > .popups > .window.door_cut__eurotermo3k ul.description_strings_list > li');

		};

		// Set click event listeners to numbers and description strings
		for( let i = 0; i < numberDots.length; i++ ){
			// On mouse enter
			numberDots[i].addEventListener('mouseenter', function(){
				schemeParent.style.backgroundPosition = '0 calc(-569px * ' + this.getAttribute('data-scheme-num') + ')';
				descriptionStrings[+this.getAttribute('data-scheme-num') - 1].classList.add('active');
			});
			descriptionStrings[i].addEventListener('mouseenter', function(){
				schemeParent.style.backgroundPosition = '0 calc(-569px * ' + this.getAttribute('data-scheme-num') + ')';
				descriptionStrings[+this.getAttribute('data-scheme-num') - 1].classList.add('active');
			});

			// On mouse out
			numberDots[i].addEventListener('mouseleave', function(){
				schemeParent.style.backgroundPosition = '0 calc(569px)';
				descriptionStrings[+this.getAttribute('data-scheme-num') - 1].classList.remove('active');
			});
			descriptionStrings[i].addEventListener('mouseleave', function(){
				schemeParent.style.backgroundPosition = '0 calc(569px)';
				descriptionStrings[+this.getAttribute('data-scheme-num') - 1].classList.remove('active');
			});
		};
	};
}());





// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Product details door shape select slider control
function doorsShapeSelect(){
	// Check if such block exist on the page
	if( !document.querySelector('main > .doors_shape_select') ){
		return;
	};

	document.querySelector('main > .doors_shape_select > .slider > .frames > ul').style.width = '100px';

	if(window.innerWidth <= 740){
		return;
	};

	var framesList = document.querySelectorAll('main > .doors_shape_select > .slider > .frames > ul > li'),
		framesParent = document.querySelector('main > .doors_shape_select > .slider > .frames > ul'),
		currentSliderPosition = 0,
		arrLeft = document.querySelector('main > .doors_shape_select > .slider > span.arr_but.left'),
		arrRight = document.querySelector('main > .doors_shape_select > .slider > span.arr_but.right');

	// Set style width to framesParent according to children nodes width sum
		var framesListWidth = 0;
		for( let i = 0; i < framesList.length; i++ ){
			framesListWidth += framesList[i].getBoundingClientRect().width;

			if( i == framesList.length - 1 ){
				framesParent.style.width = framesListWidth + 'px';
			};
		};

	// Set maximum slide action number depends on viewport width to all frames width ratio
	var maxSlideActionNum = Math.ceil( framesParent.getBoundingClientRect().width / (document.querySelector('main > .doors_shape_select > .slider').getBoundingClientRect().width / 2 ) );

	// Set arrows style depends on frams width sum
	if(currentSliderPosition == maxSlideActionNum){
		arrRight.classList.add('inactive');
	};

	function scrollSlider(whatToDo){
		if(window.innerWidth <= 740){
			return;
		};

		if( currentSliderPosition == maxSlideActionNum){
			arrRight.classList.add('inactive');
			return;
		};

		if(whatToDo == 'scrollLeft'){
			currentSliderPosition -= 1;
		} else if(whatToDo == 'scrollRight'){
			currentSliderPosition += 1;
		};

		if(currentSliderPosition < 0){
			currentSliderPosition = 0;
		} else if(currentSliderPosition > maxSlideActionNum - 2){
			currentSliderPosition = maxSlideActionNum - 2;
		};
		framesParent.style.transform = 'translateX(-' + 
		( ( document.querySelector('main > .doors_shape_select > .slider').getBoundingClientRect().width / 2 ) * currentSliderPosition) + 'px)';

		// Set arrows style
		if(currentSliderPosition == 0){
			arrLeft.classList.add('inactive');
			arrRight.classList.remove('inactive');
		} else if(currentSliderPosition == maxSlideActionNum - 2){
			arrLeft.classList.remove('inactive');
			arrRight.classList.add('inactive');
		} else{
			arrLeft.classList.remove('inactive');
			arrRight.classList.remove('inactive');
		};
	};

	arrLeft.addEventListener('click', function(){ scrollSlider('scrollLeft') });
	arrRight.addEventListener('click', function(){ scrollSlider('scrollRight') });

	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	// Set swipe processor
	var hammertime_doorsShapeSelect = new Hammer( document.querySelector('main > .doors_shape_select > .slider'), {
		enable: true,
		recognizers: [
			[Hammer.Swipe, { direction: Hammer.DIRECTION_HORIZONTAL }]
		]
	});

	hammertime_doorsShapeSelect.on('swipeleft', function(){scrollSlider('scrollRight')});
	hammertime_doorsShapeSelect.on('swiperight', function(){scrollSlider('scrollLeft')});

};

setTimeout(function(){
	doorsShapeSelect();
}, 1500);

// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------
// Change blocks and variables on screen resize

// Blocks and variables that we need to change on screen resize
var doorsConstruction__framesParent = document.querySelector('main > section.doors_construction > ul.details'),
	doorsConstruction__visibleFrame = document.querySelector('main > section.doors_construction > ul.details > li.visible'),
	doorsConstruction__firstTab = document.querySelector('main > section.doors_construction > ul.type_select > li:first-child'),
	doorsConstruction__firstFrame = document.querySelector('main > section.doors_construction > ul.details > li:first-child');

window.addEventListener('resize', function(){
	if(window.innerWidth <= 740){
		doorsShapeSelect();
		if(doorsConstruction__framesParent){
			// ----------------------------------------------------------------------------------------------
			// Doors construction block control
				// Reset style height attribute for Doors construction ul.details block for 740px and lower screen width
					// Write style value to data-style attribute and reset style attrbiute for all blocks
			if( doorsConstruction__framesParent.getAttribute('style') ){
				doorsConstruction__framesParent.setAttribute('data-style', doorsConstruction__framesParent.getAttribute('style'));
				doorsConstruction__framesParent.removeAttribute('style');
			};
		};
	} else if(window.innerWidth > 740){
		doorsShapeSelect();
		if(doorsConstruction__framesParent){
			// ----------------------------------------------------------------------------------------------
			// Doors construction block control
				// Set style height attribute for Doors construction ul.details block for 740px and larger screen width
			if( doorsConstruction__framesParent.getAttribute('data-style') ){
				doorsConstruction__framesParent.setAttribute('style', doorsConstruction__framesParent.getAttribute('data-style'));
				doorsConstruction__framesParent.removeAttribute('data-style');
			};
		};
	};

	if(window.innerWidth <= 580){
		// ----------------------------------------------------------------------------------------------
		// Main visual carousel block control
		mainVisualCarousel__visibleFrames = 1;
	} else if(window.innerWidth > 580){
		// ----------------------------------------------------------------------------------------------
		// Main visual carousel block control
		mainVisualCarousel__visibleFrames = 3;
	};

	if(window.innerWidth <= 1000){
		// ----------------------------------------------------------------------------------------------
		// Popular models slider control
		popularModelsSlider__visibleFrames = 3;
	} else if(window.innerWidth > 1000){
		// ----------------------------------------------------------------------------------------------
		// Popular models slider control
		popularModelsSlider__visibleFrames = 4;
	};
	// ----------------------------------------------------------------------------------------------
	// Regular menu list's 
	if(document.querySelector('main .regular_menu_list')){
		var regularMenuHeightReset = setTimeout(function(){
			for(let i = 0; i < document.querySelectorAll('main .regular_menu_list').length; i++){
				document.querySelectorAll('main .regular_menu_list')[i].removeAttribute('style');
			};
		}, 200);
	};

	if(window.innerWidth <= 1260){
		window.upholsteryMaterialSlider__visibleSlidesNum = 8;
		window.upholsteryColorSlider__visibleSlidesNum = 7;
	} else if(window.innerWidth > 1260){
		window.upholsteryMaterialSlider__visibleSlidesNum = 11;
		window.upholsteryColorSlider__visibleSlidesNum = 9;
	} else if(window.innerWidth <= 1000){
		window.upholsteryColorSlider__visibleSlidesNum = 9;
	};
	
});


// ----------------------------------------------------------------------------------------------
// Main visual carousel block control
if(window.innerWidth <= 580){
	// ----------------------------------------------------------------------------------------------
	// Main visual carousel block control
	mainVisualCarousel__visibleFrames = 1;
} else if(window.innerWidth > 580){
	// ----------------------------------------------------------------------------------------------
	// Main visual carousel block control
	mainVisualCarousel__visibleFrames = 3;
};

// ----------------------------------------------------------------------------------------------
// Popular models slider control
if(window.innerWidth <= 1000){
	popularModelsSlider__visibleFrames = 3;
} else if(window.innerWidth > 1000){
	// ----------------------------------------------------------------------------------------------
	// Popular models slider control
	popularModelsSlider__visibleFrames = 4;
	// ----------------------------------------------------------------------------------------------
	// Catalog list filters block control
		// Check if such block exist on the page
	if( document.querySelector('body > main.content > section.catalog_list') ){
		document.querySelector('body > main.content > section.catalog_list > .filters form').style.height = '';
	};
};