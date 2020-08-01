'use strict';

(function(){

	// Insert pages navigation block css code
	var pageSelectCss = document.createElement('style');
	pageSelectCss.innerHTML = 
	'.htmlCoding__pagesNavigation{width:240px;min-height:140px;padding:22px 20px 20px;box-sizing: border-box; position:fixed;bottom:50px;left:-240px;z-index:10;border-radius:0 5px 0 0;transition: left .2s ease,box-shadow .2s ease; box-shadow:0 5px 20px rgba(0,0,0,0); background:rgba(237,210,87,.97);}.htmlCoding__pagesNavigation.opened{left:0;box-shadow:0 5px 20px rgba(0,0,0,.3);}.htmlCoding__pagesNavigation .label{content:"Страницы";width:110px;height:32px;padding:7px 16px 0;box-sizing: border-box; border-radius:0 0 5px 5px; position: absolute;right:-71px;bottom:39px;font-size:13px; transform:rotate(-90deg);transition:background-color .2s ease; background-color:rgba(237,210,87,.85);cursor:pointer;text-align:center;}.htmlCoding__pagesNavigation .label:hover{background-color:rgba(237,210,87,.8);}.htmlCoding__pagesNavigation.opened .label{}.htmlCoding__pagesNavigation .label span{padding-right:15px;display:inline-block;background:100% calc(50% + 1px)/11px no-repeat;background-image:url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMjgiIGhlaWdodD0iMTI4IiB2aWV3Qm94PSIwIDAgMTI4IDEyOCI+ICA8ZGVmcz4gICAgPHN0eWxlPiAgICAgIC5jbHMtMSB7ICAgICAgICBmaWxsLXJ1bGU6IGV2ZW5vZGQ7ICAgICAgfSAgICA8L3N0eWxlPiAgPC9kZWZzPiAgPHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNjAuMDE4LDk0LjMzNkwxNS4wOTMsNDkuNDEyYy0wLjM1NS03LjI4LDMuMDE5LTEwLjY1NCw5Ljk0NC0xMC4xMjFsMzkuNiwzOS42LDM5LjYtMzkuNmM2LjkyNS0uNTMzLDEwLjMsMi44NDEsOS45NDQsMTAuMTIxbC00NS4xLDQ0LjkyNEM2NS44NzgsOTcuNTMyLDYzLjM5Miw5Ny41MzIsNjAuMDE4LDk0LjMzNloiLz48L3N2Zz4=);}.htmlCoding__pagesNavigation.opened .label span{background-image:url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMjgiIGhlaWdodD0iMTI4IiB2aWV3Qm94PSIwIDAgMTI4IDEyOCI+ICA8ZGVmcz4gICAgPHN0eWxlPiAgICAgIC5jbHMtMSB7ICAgICAgICBmaWxsLXJ1bGU6IGV2ZW5vZGQ7ICAgICAgfSAgICA8L3N0eWxlPiAgPC9kZWZzPiAgPHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTkuMDE4LDM2LjYzM0wxNC4wOTMsODEuNTU3Yy0wLjM1NSw3LjI4LDMuMDE5LDEwLjY1NCw5Ljk0NCwxMC4xMjFsMzkuNi0zOS42LDM5LjYsMzkuNmM2LjkyNSwwLjUzMywxMC4zLTIuODQxLDkuOTQ0LTEwLjEyMWwtNDUuMS00NC45MjRDNjQuODc4LDMzLjQzNyw2Mi4zOTIsMzMuNDM3LDU5LjAxOCwzNi42MzNaIi8+PC9zdmc+);}.htmlCoding__pagesNavigation a{color:#000;text-decoration: none;outline:none;}.htmlCoding__pagesNavigation a:hover span{text-decoration:underline;}.htmlCoding__pagesNavigation a:visited{color:#8f7f37;}.htmlCoding__pagesNavigation > ul{padding:0;margin:0;list-style-type:none;font:14px/18px Arial,Tahoma,sans-serif;}.htmlCoding__pagesNavigation > ul li{padding:3px 0 5px 0;}.htmlCoding__pagesNavigation > ul li i{color:rgba(143,127,155,.5);}';
	document.head.appendChild(pageSelectCss);

	// Create pages navigation block with pages links
	var pageSelectBlock = document.createElement('div');
	document.body.appendChild(pageSelectBlock).classList.add('htmlCoding__pagesNavigation');

	// Set pages list woth link names in Russian or English depending on what navigation language user have set
	if(navigator.language == 'ru'){
		document.querySelector('body > div.htmlCoding__pagesNavigation').innerHTML =
		'<div class="label"><span>Страницы</span></div>' +
		'<ul><li><a href="01_main.html"><span>Главная</span> <i>(готова)</i></a></li>' +
		'<ul><li><a href="02_catalog_list.html"><span>Каталог</span> <i>(готова)</i></a></li>' +
		'<ul><li><a href="03_goods_details.html"><span>Карточка товара</span> <i>(готова)</i></a></li>' +
		'<ul><li><a href="04_about_company.html"><span>О компании</span> <i>(готова)</i></a></li>' +
		'<ul><li><a href="05_delivery_and_installation.html"><span>Доставка и монтаж</span> <i>(готова)</i></a></li>' +
		'<ul><li><a href="06_contacts.html"><span>Контакты</span> <i>(готова)</i></a></li>' +
		'<ul><li><a href="07_test_page.html"><span>Тестовая страница</span> <i>(готова)</i></a></li>' +
		'</ul>';
	} else{
		document.querySelector('body > div.htmlCoding__pagesNavigation').innerHTML =
		'<div class="label"><span>Pages</span></div>' +
		'<ul><li><a href="01_main.html"><span>Main</span> <i>(ready)</i></a></li>' +
		'<ul><li><a href="02_catalog_list.html"><span>Catalog</span> <i>(ready)</i></a></li>' +
		'<ul><li><a href="03_goods_details.html"><span>Product details</span> <i>(ready)</i></a></li>' +
		'<ul><li><a href="04_about_company.html"><span>About</span> <i>(ready)</i></a></li>' +
		'<ul><li><a href="05_delivery_and_installation.html"><span>Delivey & Installation</span> <i>(ready)</i></a></li>' +
		'<ul><li><a href="06_contacts.html"><span>Contacts</span> <i>(ready)</i></a></li>' +
		'<ul><li><a href="07_test_page.html"><span>Test page</span> <i>(ready)</i></a></li>' +
		'</ul>';
	};

	// Open or close block depending on session storage parameter value
	if(sessionStorage.pagesNavigationOpened == undefined || sessionStorage.pagesNavigationOpened == 1){
		document.querySelector('body > div.htmlCoding__pagesNavigation').classList.add('opened');
	};

	// Open/Close block on label click
	document.querySelector('body > div.htmlCoding__pagesNavigation > .label').addEventListener('click', function(){
		if(document.querySelector('body > div.htmlCoding__pagesNavigation').classList.contains('opened')){
			document.querySelector('body > div.htmlCoding__pagesNavigation').classList.remove('opened');
			sessionStorage.pagesNavigationOpened = 0;
		} else{
			document.querySelector('body > div.htmlCoding__pagesNavigation').classList.add('opened');
			sessionStorage.pagesNavigationOpened = 1;
		};
	});

}());