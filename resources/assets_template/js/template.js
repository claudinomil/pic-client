/*
Template Name: Structure Model - Admin & Dashboard Template
Author: Themesbrand
Version: 3.3.0.
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Main Js File
*/

(function ($) {

    'use strict';

    function initMetisMenu() {
        //metis menu
        $("#side-menu").metisMenu();
    }

    function initLeftMenuCollapse() {
        $('#vertical-menu-btn').on('click', function (event) {
            event.preventDefault();

            $('body').toggleClass('sidebar-enable');

            if ($(window).width() >= 992) {
                $('body').toggleClass('vertical-collpsed');
            } else {
                $('body').removeClass('vertical-collpsed');

                if ($('body').hasClass('sidebar-enable')) {
                    $("#div_menu_vertical").hide();
                } else {
                    $("#div_menu_vertical").show();
                }
            }
        });
    }

    function initActiveMenu() {
        // === following js will activate the menu in left side bar based on url ====
        $("#sidebar-menu a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("mm-active"); // add active to li of the current link
                $(this).parent().parent().addClass("mm-show");
                $(this).parent().parent().prev().addClass("mm-active"); // add active class to an anchor
                $(this).parent().parent().parent().addClass("mm-active");
                $(this).parent().parent().parent().parent().addClass("mm-show"); // add active to li of the current link
                $(this).parent().parent().parent().parent().parent().addClass("mm-active");
            }
        });
    }

    function initMenuItemScroll() {
        // focus active menu in left sidebar
        $(document).ready(function () {
            if ($("#sidebar-menu").length > 0 && $("#sidebar-menu .mm-active .active").length > 0) {
                var activeMenu = $("#sidebar-menu .mm-active .active").offset().top;
                if (activeMenu > 300) {
                    activeMenu = activeMenu - 300;
                    $(".vertical-menu .simplebar-content-wrapper").animate({ scrollTop: activeMenu }, "slow");
                }
            }
        });
    }

    function initHoriMenuActive() {
        $(".navbar-nav a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("active");
                $(this).parent().parent().addClass("active");
                $(this).parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().parent().addClass("active");
            }
        });
    }

    function initFullScreen() {
        $('[data-bs-toggle="fullscreen"]').on("click", function (e) {
            e.preventDefault();
            $('body').toggleClass('fullscreen-enable');
            if (!document.fullscreenElement && /* alternative standard method */ !document.mozFullScreenElement && !document.webkitFullscreenElement) {  // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        });
        document.addEventListener('fullscreenchange', exitHandler);
        document.addEventListener("webkitfullscreenchange", exitHandler);
        document.addEventListener("mozfullscreenchange", exitHandler);
        function exitHandler() {
            if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
                console.log('pressed');
                $('body').removeClass('fullscreen-enable');
            }
        }
    }

    function initRightSidebar() {
        // right side-bar toggle
        $('.right-bar-toggle').on('click', function (e) {
            $('body').toggleClass('right-bar-enabled');
        });

        $(document).on('click', 'body', function (e) {
            if ($(e.target).closest('.right-bar-toggle, .right-bar').length > 0) {
                return;
            }

            $('body').removeClass('right-bar-enabled');
            return;
        });
    }

    function initDropdownMenu() {
        if (document.getElementById("topnav-menu-content")) {
            var elements = document.getElementById("topnav-menu-content").getElementsByTagName("a");
            for (var i = 0, len = elements.length; i < len; i++) {
                elements[i].onclick = function (elem) {
                    if (elem.target.getAttribute("href") === "#") {
                        elem.target.parentElement.classList.toggle("active");
                        elem.target.nextElementSibling.classList.toggle("show");
                    }
                }
            }
            window.addEventListener("resize", updateMenu);
        }
    }

    function updateMenu() {
        var elements = document.getElementById("topnav-menu-content").getElementsByTagName("a");
        for (var i = 0, len = elements.length; i < len; i++) {
            if (elements[i].parentElement.getAttribute("class") === "nav-item dropdown active") {
                elements[i].parentElement.classList.remove("active");
                if (elements[i].nextElementSibling !== null) {
                    elements[i].nextElementSibling.classList.remove("show");
                }
            }
        }
    }

    function initComponents() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });

        var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
        var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
            return new bootstrap.Offcanvas(offcanvasEl)
        })
    }

    function initPreloader() {
        $(window).on('load', function () {
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
        });
    }

    function initSettingsMode() {
        if (window.sessionStorage) {
            var alreadyVisitedMode = sessionStorage.getItem("is_visited_mode");
            if (!alreadyVisitedMode) {
                sessionStorage.setItem("is_visited_mode", "layout_mode_light");
            } else {
                $(".right-bar input:checkbox").prop('checked', false);
                $("#" + alreadyVisitedMode).prop('checked', true);
                updateThemeSettingMode(alreadyVisitedMode);
            }
        }
        $("#layout_mode_light, #layout_mode_dark").on("change", function (e) {
            updateThemeSettingMode(e.target.id);

            //Atualizar Registro na tabela Users
            updateRegisterUser();
        });

        // show password input value
        $("#password-addon").on('click', function () {
            if ($(this).siblings('input').length > 0) {
                $(this).siblings('input').attr('type') == "password" ? $(this).siblings('input').attr('type', 'input') : $(this).siblings('input').attr('type', 'password');
            }
        })
    }

    function updateThemeSettingMode(id) {
        if ($("#layout_mode_light").prop("checked") == true && id === "layout_mode_light") {
            $("html").removeAttr("dir");

            $("#aLogoDark").hide();
            $("#aLogoLight").show();

            $("#layout_mode_dark").prop("checked", false);
            $("#bootstrap-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/bootstrap.css');
            $("#app-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/app.css');

            sessionStorage.setItem("is_visited_mode", "layout_mode_light");
        } else if ($("#layout_mode_dark").prop("checked") == true && id === "layout_mode_dark") {
            $("html").removeAttr("dir");

            $("#aLogoDark").show();
            $("#aLogoLight").hide();

            $("#layout_mode_light").prop("checked", false);
            $("#bootstrap-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/bootstrap-dark.css');
            $("#app-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/app-dark.css');

            sessionStorage.setItem("is_visited_mode", "layout_mode_dark");
        }

    }

    function initSettingsStyle() {
        if (window.sessionStorage) {
            var alreadyVisitedStyle = sessionStorage.getItem("is_visited_style");
            if (!alreadyVisitedStyle) {
                sessionStorage.setItem("is_visited_style", "layout_style_vertical_boxed_width");
            } else {
                $(".right-bar input:checkbox").prop('checked', false);
                $("#" + alreadyVisitedStyle).prop('checked', true);
                updateThemeSettingStyle(alreadyVisitedStyle);
            }
        }
        $("#layout_style_vertical_light_sidebar, #layout_style_vertical_compact_sidebar, #layout_style_vertical_icon_sidebar, #layout_style_vertical_boxed_width, #layout_style_vertical_colored_sidebar, #layout_style_vertical_scrollable, #layout_style_horizontal_horizontal, #layout_style_horizontal_topbar_light, #layout_style_horizontal_boxed_width, #layout_style_horizontal_colored_header, #layout_style_horizontal_scrollable").on("change", function (e) {
            updateThemeSettingStyle(e.target.id);

            //Atualizar Registro na tabela Users
            updateRegisterUser();
        });
    }

    function updateThemeSettingStyle(id) {
        if ($("#layout_style_vertical_light_sidebar").prop("checked") == true && id === "layout_style_vertical_light_sidebar") {
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-topbar", "dark");

            $("#div_menu_vertical").show();

            sessionStorage.setItem("is_visited_style", "layout_style_vertical_light_sidebar");
        } else if ($("#layout_style_vertical_compact_sidebar").prop("checked") == true && id === "layout_style_vertical_compact_sidebar") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-sidebar", "dark");
            $("body").attr("data-sidebar-size", "small");

            $("#div_menu_vertical").show();

            sessionStorage.setItem("is_visited_style", "layout_style_vertical_compact_sidebar");
        } else if ($("#layout_style_vertical_icon_sidebar").prop("checked") == true && id === "layout_style_vertical_icon_sidebar") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-sidebar", "dark");
            $("body").attr("data-keep-enlarged", "true");
            $('body').toggleClass("vertical-collpsed");

            $("#div_menu_vertical").show();

            sessionStorage.setItem("is_visited_style", "layout_style_vertical_icon_sidebar");
        } else if ($("#layout_style_vertical_boxed_width").prop("checked") == true && id === "layout_style_vertical_boxed_width") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-sidebar", "dark");
            $("body").attr("data-keep-enlarged", "true");
            $('body').toggleClass("vertical-collpsed");
            $("body").attr("data-layout-size", "boxed");

            $("#div_menu_vertical").show();

            sessionStorage.setItem("is_visited_style", "layout_style_vertical_boxed_width");
        } else if ($("#layout_style_vertical_colored_sidebar").prop("checked") == true && id === "layout_style_vertical_colored_sidebar") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-sidebar", "colored");

            $("#div_menu_vertical").show();

            sessionStorage.setItem("is_visited_style", "layout_style_vertical_colored_sidebar");
        } else if ($("#layout_style_vertical_scrollable").prop("checked") == true && id === "layout_style_vertical_scrollable") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-sidebar", "dark");
            $("body").attr("data-layout-scrollable", "true");

            $("#div_menu_vertical").show();

            sessionStorage.setItem("is_visited_style", "layout_style_vertical_scrollable");
        } else if ($("#layout_style_horizontal_horizontal").prop("checked") == true && id === "layout_style_horizontal_horizontal") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-topbar", "dark");
            $("body").attr("data-layout", "horizontal");

            $("#div_menu_horizontal").show();

            sessionStorage.setItem("is_visited_style", "layout_style_horizontal_horizontal");
        } else if ($("#layout_style_horizontal_topbar_light").prop("checked") == true && id === "layout_style_horizontal_topbar_light") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-topbar", "light")
            $("body").attr("data-layout", "horizontal");

            $("#div_menu_horizontal").show();

            sessionStorage.setItem("is_visited_style", "layout_style_horizontal_topbar_light");
        } else if ($("#layout_style_horizontal_boxed_width").prop("checked") == true && id === "layout_style_horizontal_boxed_width") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-topbar", "dark");
            $("body").attr("data-layout", "horizontal");
            $("body").attr("data-layout-size", "boxed");

            $("#div_menu_horizontal").show();

            sessionStorage.setItem("is_visited_style", "layout_style_horizontal_boxed_width");
        } else if ($("#layout_style_horizontal_colored_header").prop("checked") == true && id === "layout_style_horizontal_colored_header") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_scrollable").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-topbar", "colored");
            $("body").attr("data-layout", "horizontal");

            $("#div_menu_horizontal").show();

            sessionStorage.setItem("is_visited_style", "layout_style_horizontal_colored_header");
        } else if ($("#layout_style_horizontal_scrollable").prop("checked") == true && id === "layout_style_horizontal_scrollable") {
            $("#layout_style_vertical_light_sidebar").prop("checked", false);
            $("#layout_style_vertical_compact_sidebar").prop("checked", false);
            $("#layout_style_vertical_icon_sidebar").prop("checked", false);
            $("#layout_style_vertical_boxed_width").prop("checked", false);
            $("#layout_style_vertical_colored_sidebar").prop("checked", false);
            $("#layout_style_vertical_scrollable").prop("checked", false);
            $("#layout_style_horizontal_horizontal").prop("checked", false);
            $("#layout_style_horizontal_topbar_light").prop("checked", false);
            $("#layout_style_horizontal_boxed_width").prop("checked", false);
            $("#layout_style_horizontal_colored_header").prop("checked", false);

            //Limpar Atributos
            $("body").attr("data-topbar", "");
            $("body").attr("data-sidebar", "");
            $("body").attr("data-sidebar-size", "");
            $("body").attr("data-keep-enlarged", "");
            $("body").attr("data-layout-size", "");
            $("body").attr("data-layout-scrollable", "");
            $("body").attr("data-layout", "");
            $('body').removeClass("vertical-collpsed");

            $("#div_menu_vertical").hide();
            $("#div_menu_horizontal").hide();

            //Adicionar Atributos
            $("body").attr("data-topbar", "dark");
            $("body").attr("data-layout", "horizontal");
            $("body").attr("data-layout-scrollable", "true");

            $("#div_menu_horizontal").show();

            sessionStorage.setItem("is_visited_style", "layout_style_horizontal_scrollable");
        }
    }

    function initMode() {
        if ($("#layout-mode-light").prop("checked") == true) {
            $("html").removeAttr("dir");
            $("#bootstrap-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/bootstrap.css');
            $("#app-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/app.css');
        } else if ($("#layout-mode-dark").prop("checked") == true) {
            $("html").removeAttr("dir");
            $("#bootstrap-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/bootstrap-dark.css');
            $("#app-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/app-dark.css');
        }

    }

    function modeLightDark(mode) {
        if (mode == "light-mode") {
            $("html").removeAttr("dir");
            $("#bootstrap-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/bootstrap.css');
            $("#app-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/app.css');
        } else if (mode == "dark-mode") {
            $("html").removeAttr("dir");
            $("#bootstrap-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/bootstrap-dark.css');
            $("#app-style").attr('href', window.location.protocol + '//' + window.location.host + '/build/assets/app-dark.css');
        }
    }

    function initCheckAll() {
        $('#checkAll').on('change', function () {
            $('.table-check .form-check-input').prop('checked', $(this).prop("checked"));
        });
        $('.table-check .form-check-input').change(function () {
            if ($('.table-check .form-check-input:checked').length == $('.table-check .form-check-input').length) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
        });
    }

    //Atualizar Registro na tabela Users
    function updateRegisterUser() {
        var xmode = '';
        var xstyle = '';

        if ($("#layout_mode_light").prop("checked") == true) {xmode = 'layout_mode_light';}
        if ($("#layout_mode_dark").prop("checked") == true) {xmode = 'layout_mode_dark';}

        if ($("#layout_style_vertical_light_sidebar").prop("checked") == true) {xstyle = 'layout_style_vertical_light_sidebar';}
        if ($("#layout_style_vertical_compact_sidebar").prop("checked") == true) {xstyle = 'layout_style_vertical_compact_sidebar';}
        if ($("#layout_style_vertical_icon_sidebar").prop("checked") == true) {xstyle = 'layout_style_vertical_icon_sidebar';}
        if ($("#layout_style_vertical_boxed_width").prop("checked") == true) {xstyle = 'layout_style_vertical_boxed_width';}
        if ($("#layout_style_vertical_colored_sidebar").prop("checked") == true) {xstyle = 'layout_style_vertical_colored_sidebar';}
        if ($("#layout_style_vertical_scrollable").prop("checked") == true) {xstyle = 'layout_style_vertical_scrollable';}
        if ($("#layout_style_horizontal_horizontal").prop("checked") == true) {xstyle = 'layout_style_horizontal_horizontal';}
        if ($("#layout_style_horizontal_topbar_light").prop("checked") == true) {xstyle = 'layout_style_horizontal_topbar_light';}
        if ($("#layout_style_horizontal_boxed_width").prop("checked") == true) {xstyle = 'layout_style_horizontal_boxed_width';}
        if ($("#layout_style_horizontal_colored_header").prop("checked") == true) {xstyle = 'layout_style_horizontal_colored_header';}
        if ($("#layout_style_horizontal_scrollable").prop("checked") == true) {xstyle = 'layout_style_horizontal_scrollable';}

        if (xmode != '' && xstyle != '') {
            //Header
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: '',
                url: "users/editmodestyle/"+xmode+"/"+xstyle+"/"+$('#layout_user_id').val(),
                type: "PUT",
                dataType: "json"
            });
        }
    }

    function init() {
        initMetisMenu();
        initLeftMenuCollapse();
        initActiveMenu();
        initMenuItemScroll();
        initHoriMenuActive();
        initFullScreen();
        initRightSidebar();
        initDropdownMenu();
        initComponents();
        initSettingsMode();
        initSettingsStyle();
        initMode();
        initPreloader();
        Waves.init();
        initCheckAll();
    }

    init();

})(jQuery)
