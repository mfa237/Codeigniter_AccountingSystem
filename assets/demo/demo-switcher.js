$(function() {

	var sidebarColors = "sidebar-default sidebar-bluegraylight sidebar-yellow sidebar-light-blue sidebar-black sidebar-graylight sidebar-gray sidebar-bluegray sidebar-cyan sidebar-red sidebar-orange sidebar-lime sidebar-deep-orange sidebar-light-green sidebar-green sidebar-pink sidebar-deep-purple sidebar-amber sidebar-brown sidebar-midnightblue sidebar-blue sidebar-teal sidebar-purple sidebar-indigo navbar-default navbar-graylight navbar-bluegray navbar-midnightblue navbar-bluegraylight navbar-amber navbar-deep-purple navbar-light-blue navbar-black navbar-brown navbar-orange navbar-pink navbar-lime navbar-red navbar-deep-orange navbar-yellow navbar-blue navbar-teal navbar-light-green navbar-purple navbar-gray navbar-green navbar-indigo navbar-cyan";
	var headerColors = "navbar-default navbar-gray navbar-black navbar-bluegray navbar-midnightblue navbar-green navbar-orange navbar-pink navbar-blue navbar-deep-orange navbar-lime navbar-yellow navbar-light-blue navbar-light-green navbar-deep-purple navbar-graylight navbar-brown navbar-amber navbar-teal navbar-red navbar-purple navbar-bluegraylight navbar-indigo navbar-cyan";
	
	//Show Switcher
		$(".demo-options-icon").click(function () {
			$('.demo-options').toggleClass("active");
		});

	//Switch: Fixed Header
		$('input[name="demo-fixedheader"]').on('switchChange.bootstrapSwitch', function(event, state) {
			$('#topnav').toggleClass("navbar-fixed-top navbar-static-top");
		});

	//Switch: Boxed Layout
		$('input[name="demo-boxedlayout"]').on('switchChange.bootstrapSwitch', function(event, state) {
			//change to layout-boxed
			$('body').toggleClass('layout-boxed');
			Utility.autocollapse();

			//switcher option changes
			$('#demo-boxes').toggleClass('hide');

			//remove bodybg when closed
			$('body:not(.layout-boxed)').css('background','');


		});

	//Switch: Leftbar
		$('input[name="demo-collapseleftbar"]').on('switchChange.bootstrapSwitch', function(event, state) {
			Utility.toggle_leftbar();
		});


	//Switch Horizicons
		$('input[name="demo-horizicons"]').on('switchChange.bootstrapSwitch', function(event, state) {
				//if ($('#horizontal-navbar').hasClass('large-icons-nav')) {
					$('#horizontal-navbar').toggleClass('large-icons-nav');
				//}
		});

	//Detect Changes in main file


		function leftmenu_switchchange() {
			if ($('body').hasClass('sidebar-collapsed')) {
		    	$('input[name="demo-collapseleftbar"]').bootstrapSwitch('state', true, true);
		    } else {
		    	$('input[name="demo-collapseleftbar"]').bootstrapSwitch('state', false, true);
		    }
		}

		function boxedlayout_switchchange() {
			if ($('body').hasClass('layout-boxed')) {
		    	$('input[name="demo-boxedlayout"]').bootstrapSwitch('state', true, true);
		    	$('#demo-boxes').removeClass('hide');
		    } else {
		    	$('input[name="demo-boxedlayout"]').bootstrapSwitch('state', false, true);
		    }

		    if ($('#layout-fixed').hasClass('ui-layout-container')) {
		    	$('input[name="demo-boxedlayout"]').bootstrapSwitch('disabled', true);
		    	$('input[name="demo-fixedheader"]').bootstrapSwitch('disabled', true);

		    	//hacky but works - switches on the leftbar
				$('input[name="demo-collapseleftbar"]').bootstrapSwitch('state', true, true);		    	
		    }

		}


		function horizlayout_switchchange() {
			if ($('body').hasClass('horizontal-nav')) {
				$('#demo-horizicon').removeClass('hide');
				$('#demo-colleft').addClass('hide');

				if ($('#horizontal-navbar').hasClass('large-icons-nav')) {
					$('input[name="demo-horizicons"]').bootstrapSwitch('state',false, true)
				} else {
					$('input[name="demo-horizicons"]').bootstrapSwitch('state',true, true)
				}
			}
		}

		function fixedheader_switchchange() {
			if (($('.full-height-content'))==true) {
				$('input[name="demo-fixedheader"]').bootstrapSwitch('disabled', true)
			}
		}

		$('#trigger-sidebar>a').click(function () {
			leftmenu_switchchange();
		});

		$(document).ready(function () {
			leftmenu_switchchange();
			boxedlayout_switchchange();
			horizlayout_switchchange();
			fixedheader_switchchange();
			//TODO: Check in Fixed Sidebar Mode

			var navColor = localStorage.getItem('navbar-color');
			if (navColor) {
				$('#topnav').removeClass(headerColors).addClass(navColor);
                $('div.panel-heading').css('background-color',$('#topnav').css('background-color'));
                $('div.modal-header').css('background-color',$('#topnav').css('background-color'));

                $('div.panel').css('background-color',$('#topnav').css('background-color'));
                if(navColor=="navbar-default"||navColor=="navbar-graylight"||navColor=="navbar-bluegraylight"){
                    $('#tbl_items > thead > tr > th').css('color','black');
                    $('#tbl_entries > thead > tr > th').css('color','black');
                    $('div.panel-heading b').css('color','black');
                }else{
                    $('#tbl_items > thead > tr > th').css('color','white');
                    $('#tbl_entries > thead > tr > th').css('color','white');
                    $('div.panel-heading b').css('color','white');
                }

			} else if (navColor == null) {
				$('#topnav').removeClass(headerColors).addClass('navbar-black');
                $('div.panel-heading').css('background-color',$('#topnav').css('background-color'));
                $('div.modal-header').css('background-color',$('#topnav').css('background-color'));
			}

			var sideColor = localStorage.getItem('sidebar-color');
			if (sideColor) {
				$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-' + sideColor);
				$('#headernav').removeClass(sidebarColors).addClass('navbar-' + sideColor);

			} else if (navColor == null) {
				$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-black');
				$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-black');
			}

		});






		//Header Navbar Styles
			$('#demo-header-color span').click(function() {

                var navColor;

				if ($(this).hasClass("demo-default")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-default');
					localStorage.setItem('navbar-color','navbar-default');
                    navColor='navbar-default';
				}

				if ($(this).hasClass("demo-bluegray")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-bluegray');
					localStorage.setItem('navbar-color', 'navbar-bluegray');
				}

				if ($(this).hasClass("demo-bluegraylight")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-bluegraylight');
					localStorage.setItem('navbar-color', 'navbar-bluegraylight');
                    navColor='navbar-bluegraylight';
				}

				if ($(this).hasClass("demo-yellow")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-yellow');
					localStorage.setItem('navbar-color', 'navbar-yellow');
				}

				if ($(this).hasClass("demo-black")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-black');
					localStorage.setItem('navbar-color', 'navbar-black');
				}

				if ($(this).hasClass("demo-light-blue")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-light-blue');
					localStorage.setItem('navbar-color', 'navbar-light-blue');
				}

				if ($(this).hasClass("demo-gray")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-gray');
					localStorage.setItem('navbar-color', 'navbar-gray');
                    navColor='navbar-gray';
				}

				if ($(this).hasClass("demo-graylight")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-graylight');
					localStorage.setItem('navbar-color', 'navbar-graylight');
                    navColor='navbar-graylight';
				}

				if ($(this).hasClass("demo-midnightblue")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-midnightblue');
					localStorage.setItem('navbar-color', 'navbar-midnightblue');
				}

				if ($(this).hasClass("demo-orange")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-orange');
					localStorage.setItem('navbar-color', 'navbar-orange');
				}

				if ($(this).hasClass("demo-blue")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-blue');
					localStorage.setItem('navbar-color', 'navbar-blue');
				}

				if ($(this).hasClass("demo-teal")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-teal');
					localStorage.setItem('navbar-color', 'navbar-teal');
				}

				if ($(this).hasClass("demo-purple")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-purple');
					localStorage.setItem('navbar-color', 'navbar-purple');
				}

				if ($(this).hasClass("demo-indigo")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-indigo');
					localStorage.setItem('navbar-color', 'navbar-indigo');
				}

				if ($(this).hasClass("demo-cyan")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-cyan');
					localStorage.setItem('navbar-color', 'navbar-cyan');
				}

				if ($(this).hasClass("demo-red")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-red');
					localStorage.setItem('navbar-color', 'navbar-red');
				}

				if ($(this).hasClass("demo-pink")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-pink');
					localStorage.setItem('navbar-color', 'navbar-pink');
				}

				if ($(this).hasClass("demo-deep-purple")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-deep-purple');
					localStorage.setItem('navbar-color', 'navbar-deep-purple');
				}

				if ($(this).hasClass("demo-brown")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-brown');
					localStorage.setItem('navbar-color', 'navbar-brown');
				}

				if ($(this).hasClass("demo-green")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-green');
					localStorage.setItem('navbar-color', 'navbar-green');
				}

				if ($(this).hasClass("demo-light-green")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-light-green');
					localStorage.setItem('navbar-color', 'navbar-light-green');
				}

				if ($(this).hasClass("demo-deep-orange")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-deep-orange');
					localStorage.setItem('navbar-color', 'navbar-deep-orange');
				}

				if ($(this).hasClass("demo-lime")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-lime');
					localStorage.setItem('navbar-color', 'navbar-lime');
				}

				if ($(this).hasClass("demo-amber")) {
					$('#topnav').removeClass(headerColors).addClass('navbar-amber');
					localStorage.setItem('navbar-color', 'navbar-amber');
				}

                //all heading panel should match the color of top nav
                $('div.panel-heading').css('background-color',$('#topnav').css('background-color'));
                $('div.modal-header').css('background-color',$('#topnav').css('background-color'));

                $('div.panel').css('background-color',$('#topnav').css('background-color'));
                if(navColor=="navbar-default"||navColor=="navbar-graylight"||navColor=="navbar-bluegraylight"){
                    $('#tbl_items > thead > tr > th').css('color','black');
                    $('#tbl_entries > thead > tr > th').css('color','black');
                    $('div.panel-heading b').css('color','black');
                }else{
                    $('#tbl_items > thead > tr > th').css('color','white');
                    $('#tbl_entries > thead > tr > th').css('color','white');
                    $('div.panel-heading b').css('color','white');
                }

			});

		//Sidebar Navbar Styles
			$('#demo-sidebar-color span').click(function() {


				if ($(this).hasClass("demo-default")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-default');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-default');

					localStorage.setItem('sidebar-color',"default");
				}

				if ($(this).hasClass("demo-bluegray")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-bluegray');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-bluegray');

					localStorage.setItem('sidebar-color',"bluegray");
				}

				if ($(this).hasClass("demo-bluegraylight")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-bluegraylight');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-bluegraylight');

					localStorage.setItem('sidebar-color',"bluegraylight");
				}

				if ($(this).hasClass("demo-yellow")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-yellow');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-yellow');

					localStorage.setItem('sidebar-color',"yellow");
				}

				if ($(this).hasClass("demo-light-blue")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-light-blue');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-light-blue');

					localStorage.setItem('sidebar-color',"light-blue");
				}

				if ($(this).hasClass("demo-black")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-black');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-black');

					localStorage.setItem('sidebar-color',"black");
				}

				if ($(this).hasClass("demo-gray")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-gray');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-gray');

					localStorage.setItem('sidebar-color',"gray");
				}

				if ($(this).hasClass("demo-graylight")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-graylight');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-graylight');

					localStorage.setItem('sidebar-color',"graylight");
				}

				if ($(this).hasClass("demo-midnightblue")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-midnightblue');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-midnightblue');

					localStorage.setItem('sidebar-color',"midnightblue");
				}

				if ($(this).hasClass("demo-orange")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-orange');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-orange');

					localStorage.setItem('sidebar-color',"orange");
				}

				if ($(this).hasClass("demo-blue")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-blue');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-blue');

					localStorage.setItem('sidebar-color',"blue");
				}

				if ($(this).hasClass("demo-teal")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-teal');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-teal');

					localStorage.setItem('sidebar-color',"teal");
				}

				if ($(this).hasClass("demo-purple")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-purple');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-purple');

					localStorage.setItem('sidebar-color',"purple");
				}

				if ($(this).hasClass("demo-indigo")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-indigo');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-indigo');

					localStorage.setItem('sidebar-color',"indigo");
				}

				if ($(this).hasClass("demo-cyan")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-cyan');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-cyan');

					localStorage.setItem('sidebar-color',"cyan");
				}

				if ($(this).hasClass("demo-red")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-red');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-red');

					localStorage.setItem('sidebar-color',"red");
				}

				if ($(this).hasClass("demo-pink")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-pink');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-pink');

					localStorage.setItem('sidebar-color',"pink");
				}

				if ($(this).hasClass("demo-deep-purple")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-deep-purple');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-deep-purple');

					localStorage.setItem('sidebar-color',"deep-purple");
				}

				if ($(this).hasClass("demo-brown")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-brown');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-brown');

					localStorage.setItem('sidebar-color',"brown");
				}

				if ($(this).hasClass("demo-green")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-green');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-green');

					localStorage.setItem('sidebar-color',"green");
				}

				if ($(this).hasClass("demo-light-green")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-light-green');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-light-green');

					localStorage.setItem('sidebar-color',"light-green");
				}

				if ($(this).hasClass("demo-deep-orange")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-deep-orange');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-deep-orange');

					localStorage.setItem('sidebar-color',"deep-orange");
				}

				if ($(this).hasClass("demo-lime")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-lime');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-lime');

					localStorage.setItem('sidebar-color',"lime");
				}

				if ($(this).hasClass("demo-amber")) {
					$('.static-sidebar-wrapper, .fixed-sidebar-wrapper').removeClass(sidebarColors).addClass('sidebar-amber');
					$('#wrapper>nav.navbar').removeClass(sidebarColors).addClass('navbar-amber');

					localStorage.setItem('sidebar-color',"amber");
				}

				
			});

		//Boxed Backgrounds
			$('#demo-boxed-bg span').click(function() {
				$('body.layout-boxed').css('background', $(this).css('background'));
			});

		//Fixed Header

			$('#demo-fixedheader').click(function () {
				$('body>header.navbar').toggleClass('navbar-fixed-top navbar-static-top')
			})

		//Reset to default style
			$('.demo-reset').click(function () {
				if (!($('header.navbar').hasClass('navbar-bluegray'))) {
					$('header.navbar').addClass('navbar-bluegray');
				}
			});
});