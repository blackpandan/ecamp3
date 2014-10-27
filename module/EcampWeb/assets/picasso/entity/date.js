/**
 * Created by pirmin on 21.10.14.
 */

CNS('ecamp.picasso.entity');

ecamp.picasso.entity.Date = function($scope, date){
    this.id = date.getTime();
    this.date = date;
    this.leftOffset = 0;
    this.dayCount = 0;

    this.style = function(){
        return {
            left: this.leftOffset * $scope.appearance.dayWidth,
            width: this.dayCount * $scope.appearance.dayWidth
        };
    };
};

ecamp.picasso.entity.Date.Key = function(date){
    return date.getTime();
};

ecamp.picasso.entity.Date.Insert = function($scope, date){
    return new ecamp.picasso.entity.Date($scope, date);
};

ecamp.picasso.entity.Date.Update = function(dateModel, date){
    dateModel.date = date;
    return dateModel;
};

ecamp.picasso.entity.Date.Sort = function(d1, d2){
    return d1.date.getTime() - d2.date.getTime();
};