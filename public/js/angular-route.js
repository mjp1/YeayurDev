

var app = angular.module('myApp', ['infinite-scroll']);

app.controller('twitchCtrl', function($scope, $http) {
  $http.get('https://api.twitch.tv/kraken/streams?&limit=24').success(
    function(data) {
      $scope.data = data.streams;
    });
  $scope.loadMore = function($count) {

      // Count number of steams //
      var $count = $scope.data.length;
      $http.get("https://api.twitch.tv/kraken/streams?&limit=24&offset=" + $count)
        .success(function(data) {
          [].push.apply($scope.data, data.streams);
        });
    }
    /* GRABS STREAMER NAME AND SETS TO VARIABLE */
        /*$scope.twitchName() = function(x) {
          $twitchName = x.channel.display_name;
        }*/

        
});

	
