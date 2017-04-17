angular.module("menu.controllers", [])



.controller("indexCtrl", function($scope,$state,$ionicScrollDelegate,$http,$stateParams,$timeout,$ionicLoading,$ionicPopup,$ionicPopover,$ionicSlideBoxDelegate,$ionicHistory,ionicMaterialInk,ionicMaterialMotion){
	
	$scope.scrollTop = function(){
		$ionicScrollDelegate.$getByHandle("top").scrollTop();
	};
	// open external browser 
	$scope.openURL = function($url){
		window.open($url,"_system","location=yes");
	};
	// open AppBrowser
	$scope.openAppBrowser = function($url){
		window.open($url,"_blank","closebuttoncaption=Done");
	};
	// open WebView
	$scope.openWebView = function($url){
		window.open($url,"_self");
	};
	
	// Set Motion
	$timeout(function(){
		ionicMaterialMotion.slideUp({
			selector: ".slide-up"
		});
	}, 300);

	
	// animation ink (ionic-material)
	ionicMaterialInk.displayEffect();
	$scope.rating = {};
	$scope.rating.max = 5;
})

.controller("cb_clientes_singlesCtrl", function($scope,$state,$ionicScrollDelegate,$http,$stateParams,$timeout,$ionicLoading,$ionicPopup,$ionicPopover,$ionicSlideBoxDelegate,$ionicHistory,ionicMaterialInk,ionicMaterialMotion){
	
	$scope.scrollTop = function(){
		$ionicScrollDelegate.$getByHandle("top").scrollTop();
	};
	// open external browser 
	$scope.openURL = function($url){
		window.open($url,"_system","location=yes");
	};
	// open AppBrowser
	$scope.openAppBrowser = function($url){
		window.open($url,"_blank","closebuttoncaption=Done");
	};
	// open WebView
	$scope.openWebView = function($url){
		window.open($url,"_self");
	};
	
	// Set Motion
	$timeout(function(){
		ionicMaterialMotion.slideUp({
			selector: ".slide-up"
		});
	}, 300);
	// animation loading 
	$ionicLoading.show({
		template: '<div class="loader"><svg class="circular"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>'
	});
	
	// Retrieving data
	var itemID = $stateParams.id;
	var current_item = [];
	if(window.localStorage.getItem("data_cb_clientess") !== "undefined"){
		var datas = JSON.parse(window.localStorage.getItem("data_cb_clientess"));
		for (var i = 0; i < datas.length; i++) {
			if((datas[i].id ===  parseInt(itemID)) || (datas[i].id === itemID.toString())) {
				current_item = datas[i] ;
			}
		}
		// event done, hidden animation loading
		$timeout(function() {
			$ionicLoading.hide();
		$scope.cb_clientes = current_item ;
		}, 500);
	};
	if(!angular.isObject(current_item)){
		var itemID = $stateParams.id;
		var current_item = [];
		$http.get("http://www.fullcontent.com.br/www_arteaovento2/public/rest-api.php?json=cb_clientes").then(function(response) {
			// Get data single
			var datas = response.data;
			try {
				window.localStorage.setItem("data_cb_clientess",JSON.stringify(datas));
			} catch(e) {
				window.localStorage.clear();
				window.localStorage.setItem("data_cb_clientess",JSON.stringify(datas));
				$ionicHistory.clearCache();
				$ionicHistory.clearHistory();
				$state.reload();
				$scope.$state = $state;
			}
			for (var i = 0; i < datas.length; i++) {
				if((datas[i].id ===  parseInt(itemID)) || (datas[i].id === itemID.toString())) {
					current_item = datas[i] ;
				}
			}
		},function(response) {
			// Error message
			var alertPopup = $ionicPopup.alert({
				title: "Error " + response.status,
				template: "There was a problem with the network response. (" + response.statusText + ")",
			});
		}).finally(function() {
			$scope.$broadcast("scroll.refreshComplete");
			// event done, hidden animation loading
			$timeout(function() {
				$ionicLoading.hide();
			$scope.cb_clientes = current_item ;
			}, 500);
		});
	}
	$scope.doRefresh = function(){
		// Retrieving data
		window.localStorage.clear();
		var itemID = $stateParams.id;
		var current_item = [];
		$http.get("http://www.fullcontent.com.br/www_arteaovento2/public/rest-api.php?json=cb_clientes").then(function(response) {
			// Get data single
			var datas = response.data;
			window.localStorage.setItem("data_cb_clientess",JSON.stringify(datas));
			for (var i = 0; i < datas.length; i++) {
				if((datas[i].id ===  parseInt(itemID)) || (datas[i].id === itemID.toString())) {
					current_item = datas[i] ;
				}
			}
		},function(response) {
			// Error message
			var alertPopup = $ionicPopup.alert({
				title: "Error " + response.status,
				template: "There was a problem with the network response. (" + response.statusText + ")",
			});
		}).finally(function() {
			$scope.$broadcast("scroll.refreshComplete");
			// event done, hidden animation loading
			$timeout(function() {
				$ionicLoading.hide();
			$scope.cb_clientes = current_item ;
			}, 500);
		});
	};

	
	// animation ink (ionic-material)
	ionicMaterialInk.displayEffect();
	$scope.rating = {};
	$scope.rating.max = 5;
})

.controller("cb_produtos_singlesCtrl", function($scope,$state,$ionicScrollDelegate,$http,$stateParams,$timeout,$ionicLoading,$ionicPopup,$ionicPopover,$ionicSlideBoxDelegate,$ionicHistory,ionicMaterialInk,ionicMaterialMotion){
	
	$scope.scrollTop = function(){
		$ionicScrollDelegate.$getByHandle("top").scrollTop();
	};
	// open external browser 
	$scope.openURL = function($url){
		window.open($url,"_system","location=yes");
	};
	// open AppBrowser
	$scope.openAppBrowser = function($url){
		window.open($url,"_blank","closebuttoncaption=Done");
	};
	// open WebView
	$scope.openWebView = function($url){
		window.open($url,"_self");
	};
	
	// Set Motion
	$timeout(function(){
		ionicMaterialMotion.slideUp({
			selector: ".slide-up"
		});
	}, 300);
	// animation loading 
	$ionicLoading.show({
		template: '<div class="loader"><svg class="circular"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>'
	});
	
	// Retrieving data
	var itemID = $stateParams.id;
	var current_item = [];
	if(window.localStorage.getItem("data_cb_produtoss") !== "undefined"){
		var datas = JSON.parse(window.localStorage.getItem("data_cb_produtoss"));
		for (var i = 0; i < datas.length; i++) {
			if((datas[i].id ===  parseInt(itemID)) || (datas[i].id === itemID.toString())) {
				current_item = datas[i] ;
			}
		}
		// event done, hidden animation loading
		$timeout(function() {
			$ionicLoading.hide();
		$scope.cb_produtos = current_item ;
		}, 500);
	};
	if(!angular.isObject(current_item)){
		var itemID = $stateParams.id;
		var current_item = [];
		$http.get("http://www.fullcontent.com.br/www_arteaovento2/public/rest-api.php?json=cb_produtos").then(function(response) {
			// Get data single
			var datas = response.data;
			try {
				window.localStorage.setItem("data_cb_produtoss",JSON.stringify(datas));
			} catch(e) {
				window.localStorage.clear();
				window.localStorage.setItem("data_cb_produtoss",JSON.stringify(datas));
				$ionicHistory.clearCache();
				$ionicHistory.clearHistory();
				$state.reload();
				$scope.$state = $state;
			}
			for (var i = 0; i < datas.length; i++) {
				if((datas[i].id ===  parseInt(itemID)) || (datas[i].id === itemID.toString())) {
					current_item = datas[i] ;
				}
			}
		},function(response) {
			// Error message
			var alertPopup = $ionicPopup.alert({
				title: "Error " + response.status,
				template: "There was a problem with the network response. (" + response.statusText + ")",
			});
		}).finally(function() {
			$scope.$broadcast("scroll.refreshComplete");
			// event done, hidden animation loading
			$timeout(function() {
				$ionicLoading.hide();
			$scope.cb_produtos = current_item ;
			}, 500);
		});
	}
	$scope.doRefresh = function(){
		// Retrieving data
		window.localStorage.clear();
		var itemID = $stateParams.id;
		var current_item = [];
		$http.get("http://www.fullcontent.com.br/www_arteaovento2/public/rest-api.php?json=cb_produtos").then(function(response) {
			// Get data single
			var datas = response.data;
			window.localStorage.setItem("data_cb_produtoss",JSON.stringify(datas));
			for (var i = 0; i < datas.length; i++) {
				if((datas[i].id ===  parseInt(itemID)) || (datas[i].id === itemID.toString())) {
					current_item = datas[i] ;
				}
			}
		},function(response) {
			// Error message
			var alertPopup = $ionicPopup.alert({
				title: "Error " + response.status,
				template: "There was a problem with the network response. (" + response.statusText + ")",
			});
		}).finally(function() {
			$scope.$broadcast("scroll.refreshComplete");
			// event done, hidden animation loading
			$timeout(function() {
				$ionicLoading.hide();
			$scope.cb_produtos = current_item ;
			}, 500);
		});
	};

	
	// animation ink (ionic-material)
	ionicMaterialInk.displayEffect();
	$scope.rating = {};
	$scope.rating.max = 5;
})

.controller("clientesCtrl", function($scope,$state,$ionicScrollDelegate,$http,$stateParams,$timeout,$ionicLoading,$ionicPopup,$ionicPopover,$ionicSlideBoxDelegate,$ionicHistory,ionicMaterialInk,ionicMaterialMotion){
	
	$scope.scrollTop = function(){
		$ionicScrollDelegate.$getByHandle("top").scrollTop();
	};
	// open external browser 
	$scope.openURL = function($url){
		window.open($url,"_system","location=yes");
	};
	// open AppBrowser
	$scope.openAppBrowser = function($url){
		window.open($url,"_blank","closebuttoncaption=Done");
	};
	// open WebView
	$scope.openWebView = function($url){
		window.open($url,"_self");
	};
	
	// Set Motion
	$timeout(function(){
		ionicMaterialMotion.slideUp({
			selector: ".slide-up"
		});
	}, 300);
	var targetQuery = ""; //default param
	var raplaceWithQuery = "";
	// TODO: Dinamics Clientes
	targetQuery = "json=cb_clientes"; //default param
	raplaceWithQuery = "json=cb_clientes";
	
	console.log(targetQuery,raplaceWithQuery);
	
	var fetch_per_scroll = 1;
	// animation loading 
	$ionicLoading.show({
		template: '<div class="loader"><svg class="circular"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>'
	});
	
	
	$scope.noMoreItemsAvailable = false; //readmore status
	var lastPush = 0;
	var data_cb_clientess = [];
	
	if(window.localStorage.getItem("data_cb_clientess") !== "undefined"){
		data_cb_clientess = JSON.parse(window.localStorage.getItem("data_cb_clientess"));
			if (data_cb_clientess !== null){
			$scope.cb_clientess = [];
			for(lastPush = 0; lastPush < 10; lastPush++) {
				if (angular.isObject(data_cb_clientess[lastPush])){
					$scope.cb_clientess.push(data_cb_clientess[lastPush]);
				};
			}
			$timeout(function() {
				$ionicLoading.hide();
			}, 100);
		}
	}
	if(!angular.isObject(data_cb_clientess)){
		$timeout(function() {
		// retry retrieving data
		$http.get("http://www.fullcontent.com.br/www_arteaovento2/public/rest-api.php?json=cb_clientes".replace(targetQuery,raplaceWithQuery)).then(function(response) {
			data_cb_clientess = response.data;
			if(typeof(Storage) != "undefined"){
				try {
					window.localStorage.setItem("data_cb_clientess",JSON.stringify(data_cb_clientess));
				} catch(e) {
					window.localStorage.clear();
					window.localStorage.setItem("data_cb_clientess",JSON.stringify(data_cb_clientess));
					$ionicHistory.clearCache();
					$ionicHistory.clearHistory();
					$state.reload();
					$scope.$state = $state;
				}
			}
			$scope.cb_clientess = [];
			for(lastPush = 0; lastPush < 100; lastPush++) {
				if (angular.isObject(data_cb_clientess[lastPush])){
					$scope.cb_clientess.push(data_cb_clientess[lastPush]);
				};
			}
		},function(response) {
			// error message
			var alertPopup = $ionicPopup.alert({
				title: "Error " + response.status,
				template: "There was a problem with the network response. (" + response.statusText + ")",
			});
		}).finally(function() {
			$scope.$broadcast("scroll.refreshComplete");
			// event done, hidden animation loading
			$timeout(function() {
				$ionicLoading.hide();
			}, 1000);
		});
	
		}, 1000);
	}
	$scope.doRefresh = function(){
		// retry retrieving data
		window.localStorage.clear();
		$http.get( "http://www.fullcontent.com.br/www_arteaovento2/public/rest-api.php?json=cb_clientes".replace(targetQuery,raplaceWithQuery)).then(function(response) {
			data_cb_clientess = response.data;
			if(typeof(Storage) != "undefined"){
				try {
					window.localStorage.setItem("data_cb_clientess",JSON.stringify(data_cb_clientess));
				} catch(e) {
					window.localStorage.clear();
					window.localStorage.setItem("data_cb_clientess",JSON.stringify(data_cb_clientess));
					$ionicHistory.clearCache();
					$ionicHistory.clearHistory();
					$state.reload();
					$scope.$state = $state;
				}
			}
			$scope.cb_clientess = [];
			for(lastPush = 0; lastPush < 100; lastPush++) {
				if (angular.isObject(data_cb_clientess[lastPush])){
					$scope.cb_clientess.push(data_cb_clientess[lastPush]);
				};
			}
		},function(response) {
			// error message
			var alertPopup = $ionicPopup.alert({
				title: "Error " + response.status,
				template: "There was a problem with the network response. (" + response.statusText + ")",
			});
		}).finally(function() {
			$scope.$broadcast("scroll.refreshComplete");
			// event done, hidden animation loading
			$timeout(function() {
				$ionicLoading.hide();
			}, 100);
		});
	
	};
	if (data_cb_clientess === null){
		data_cb_clientess = [];
	};
	// animation readmore
	var fetchItems = function() {
		for(var z=0;z<fetch_per_scroll;z++){
			if (angular.isObject(data_cb_clientess[lastPush])){
				$scope.cb_clientess.push(data_cb_clientess[lastPush]);
				lastPush++;
			}else{;
				$scope.noMoreItemsAvailable = true;
			}
		}
		$scope.$broadcast("scroll.infiniteScrollComplete");
	};
	
	// event readmore
	$scope.onInfinite = function() {
		$timeout(fetchItems, 500);
	};
	
	// create animation fade slide in right (ionic-material)
	$scope.fireEvent = function(){
		ionicMaterialMotion.fadeSlideInRight();
	ionicMaterialInk.displayEffect();
	};

	
	// animation ink (ionic-material)
	ionicMaterialInk.displayEffect();
	$scope.rating = {};
	$scope.rating.max = 5;
})

.controller("produtosCtrl", function($scope,$state,$ionicScrollDelegate,$http,$stateParams,$timeout,$ionicLoading,$ionicPopup,$ionicPopover,$ionicSlideBoxDelegate,$ionicHistory,ionicMaterialInk,ionicMaterialMotion){
	
	$scope.scrollTop = function(){
		$ionicScrollDelegate.$getByHandle("top").scrollTop();
	};
	// open external browser 
	$scope.openURL = function($url){
		window.open($url,"_system","location=yes");
	};
	// open AppBrowser
	$scope.openAppBrowser = function($url){
		window.open($url,"_blank","closebuttoncaption=Done");
	};
	// open WebView
	$scope.openWebView = function($url){
		window.open($url,"_self");
	};
	
	// Set Motion
	$timeout(function(){
		ionicMaterialMotion.slideUp({
			selector: ".slide-up"
		});
	}, 300);
	var targetQuery = ""; //default param
	var raplaceWithQuery = "";
	// TODO: Dinamics Produtos
	targetQuery = "json=cb_produtos"; //default param
	raplaceWithQuery = "json=cb_produtos";
	
	console.log(targetQuery,raplaceWithQuery);
	
	var fetch_per_scroll = 1;
	// animation loading 
	$ionicLoading.show({
		template: '<div class="loader"><svg class="circular"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>'
	});
	
	
	$scope.noMoreItemsAvailable = false; //readmore status
	var lastPush = 0;
	var data_cb_produtoss = [];
	
	if(window.localStorage.getItem("data_cb_produtoss") !== "undefined"){
		data_cb_produtoss = JSON.parse(window.localStorage.getItem("data_cb_produtoss"));
			if (data_cb_produtoss !== null){
			$scope.cb_produtoss = [];
			for(lastPush = 0; lastPush < 10; lastPush++) {
				if (angular.isObject(data_cb_produtoss[lastPush])){
					$scope.cb_produtoss.push(data_cb_produtoss[lastPush]);
				};
			}
			$timeout(function() {
				$ionicLoading.hide();
			}, 100);
		}
	}
	if(!angular.isObject(data_cb_produtoss)){
		$timeout(function() {
		// retry retrieving data
		$http.get("http://www.fullcontent.com.br/www_arteaovento2/public/rest-api.php?json=cb_produtos".replace(targetQuery,raplaceWithQuery)).then(function(response) {
			data_cb_produtoss = response.data;
			if(typeof(Storage) != "undefined"){
				try {
					window.localStorage.setItem("data_cb_produtoss",JSON.stringify(data_cb_produtoss));
				} catch(e) {
					window.localStorage.clear();
					window.localStorage.setItem("data_cb_produtoss",JSON.stringify(data_cb_produtoss));
					$ionicHistory.clearCache();
					$ionicHistory.clearHistory();
					$state.reload();
					$scope.$state = $state;
				}
			}
			$scope.cb_produtoss = [];
			for(lastPush = 0; lastPush < 100; lastPush++) {
				if (angular.isObject(data_cb_produtoss[lastPush])){
					$scope.cb_produtoss.push(data_cb_produtoss[lastPush]);
				};
			}
		},function(response) {
			// error message
			var alertPopup = $ionicPopup.alert({
				title: "Error " + response.status,
				template: "There was a problem with the network response. (" + response.statusText + ")",
			});
		}).finally(function() {
			$scope.$broadcast("scroll.refreshComplete");
			// event done, hidden animation loading
			$timeout(function() {
				$ionicLoading.hide();
			}, 1000);
		});
	
		}, 1000);
	}
	$scope.doRefresh = function(){
		// retry retrieving data
		window.localStorage.clear();
		$http.get( "http://www.fullcontent.com.br/www_arteaovento2/public/rest-api.php?json=cb_produtos".replace(targetQuery,raplaceWithQuery)).then(function(response) {
			data_cb_produtoss = response.data;
			if(typeof(Storage) != "undefined"){
				try {
					window.localStorage.setItem("data_cb_produtoss",JSON.stringify(data_cb_produtoss));
				} catch(e) {
					window.localStorage.clear();
					window.localStorage.setItem("data_cb_produtoss",JSON.stringify(data_cb_produtoss));
					$ionicHistory.clearCache();
					$ionicHistory.clearHistory();
					$state.reload();
					$scope.$state = $state;
				}
			}
			$scope.cb_produtoss = [];
			for(lastPush = 0; lastPush < 100; lastPush++) {
				if (angular.isObject(data_cb_produtoss[lastPush])){
					$scope.cb_produtoss.push(data_cb_produtoss[lastPush]);
				};
			}
		},function(response) {
			// error message
			var alertPopup = $ionicPopup.alert({
				title: "Error " + response.status,
				template: "There was a problem with the network response. (" + response.statusText + ")",
			});
		}).finally(function() {
			$scope.$broadcast("scroll.refreshComplete");
			// event done, hidden animation loading
			$timeout(function() {
				$ionicLoading.hide();
			}, 100);
		});
	
	};
	if (data_cb_produtoss === null){
		data_cb_produtoss = [];
	};
	// animation readmore
	var fetchItems = function() {
		for(var z=0;z<fetch_per_scroll;z++){
			if (angular.isObject(data_cb_produtoss[lastPush])){
				$scope.cb_produtoss.push(data_cb_produtoss[lastPush]);
				lastPush++;
			}else{;
				$scope.noMoreItemsAvailable = true;
			}
		}
		$scope.$broadcast("scroll.infiniteScrollComplete");
	};
	
	// event readmore
	$scope.onInfinite = function() {
		$timeout(fetchItems, 500);
	};
	
	// create animation fade slide in right (ionic-material)
	$scope.fireEvent = function(){
		ionicMaterialMotion.fadeSlideInRight();
	ionicMaterialInk.displayEffect();
	};

	
	// animation ink (ionic-material)
	ionicMaterialInk.displayEffect();
	$scope.rating = {};
	$scope.rating.max = 5;
})
