angular.module("menu", ["ionic","ionMdInput","ionic-material","ionic.rating","ionicLazyLoad","menu.controllers", "menu.services"])
	.run(function($ionicPlatform) {
		$ionicPlatform.ready(function() {
			if(window.cordova && window.cordova.plugins.Keyboard) {
				cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
				cordova.plugins.Keyboard.disableScroll(true);
			}

			if(window.StatusBar) {
				StatusBar.styleDefault();
			}

			setTimeout(function() {
			}, 100);

		});
	})


	.filter("to_trusted", ["$sce", function($sce){
		return function(text) {
			return $sce.trustAsHtml(text);
		};
	}])
	.filter("trustUrl", function($sce) {
		return function(url) {
			return $sce.trustAsResourceUrl(url);
		};
	})





.config(function($stateProvider, $urlRouterProvider,$sceDelegateProvider) {
	// Domain Whitelist
	$sceDelegateProvider.resourceUrlWhitelist([
		"self",
		new RegExp('^(http[s]?):\/\/(w{3}.)?youtube\.com/.+$'),
		new RegExp('^(http[s]?):\/\/(w{3}.)?w3schools\.com/.+$'),
	]);
	$stateProvider
	.state("menu",{
		url: "/menu",
		abstract: true,
		templateUrl: "templates/menu-tabs.html",
	})

	.state("menu.cb_clientes_singles", {
		url: "/cb_clientes_singles/:id",
		cache:false,
		views: {
			"menu-clientes" : {
						templateUrl:"templates/menu-cb_clientes_singles.html",
						controller: "cb_clientes_singlesCtrl"
					},
		}
	})

	.state("menu.cb_produtos_singles", {
		url: "/cb_produtos_singles/:id",
		cache:false,
		views: {
			"menu-produtos" : {
						templateUrl:"templates/menu-cb_produtos_singles.html",
						controller: "cb_produtos_singlesCtrl"
					},
		}
	})

	.state("menu.clientes", {
		url: "/clientes",
		cache:false,
		views: {
			"menu-clientes" : {
						templateUrl:"templates/menu-clientes.html",
						controller: "clientesCtrl"
					},
		}
	})

	.state("menu.produtos", {
		url: "/produtos",
		cache:false,
		views: {
			"menu-produtos" : {
						templateUrl:"templates/menu-produtos.html",
						controller: "produtosCtrl"
					},
		}
	})

	$urlRouterProvider.otherwise("/menu/produtos");
});
