angular.module('iAdvizeFilters', [])
    .filter('trim', function() {
        return function(text) {
            return String(text).replace(/\s/mg, "");
        };
    })
    .filter('dateFr', function($filter) {
        return function(input) {
            if(input == null){ return ""; }

            var _date = $filter('date')(new Date(input), 'dd-MM-yyyy HH:mm');

            return _date.toUpperCase();

        };
    });

;