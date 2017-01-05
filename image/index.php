<script>
     $(document).ready(function() {
            var category = '';
            
            $(".appDesSubmit").click(function() {
                var data = {
                     description: JSON.stringify(window.category),
                     csrf_token: '<?php print $csrf_token; ?>',
                     submit: 1
                 };

                 var url = <?php print "'".$this->appUrls['BRAND_NOTIFICATION_APP_DESCRIPTION_URL']."'";?>;
                 customAjaxCall(url, data, appDesResponse);
                 return false; 
            });
            
            function appDesResponse(output){
                alert(output.message);
            }

     });
</script>

<h3 style="margin-bottom:25px;">User Profile</h3>
<div class="row" >
   <div class="col-md-12">
       <form  class="form" >
                <div class="form-group">
                    <div name="form" ng-controller="MainCtrl as mc">
                        <category ng-repeat="cat in mc.main.categories">
                            <div class="first-level"> 
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="usr">Icon</label>
                                            <input type="text" name="icon" class="form-control" ng-model="mc.main.categories[$index].i">   
                                        </div>      
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="usr">Title</label>
                                            <input type="text" name="title" class="form-control" ng-model="mc.main.categories[$index].t">   
                                        </div>      
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                              <label for="usr">Notification</label>
                                            <span class="ui-select">
                                                <select ng-model="mc.main.categories[$index].n" name="notification"> 
                                                    <?php if(!empty($notificationName) && is_array($notificationName)){
                                                        foreach($notificationName as $row => $value){?>
                                                        <option  value="<?php  print $value['notificationID'];?>"><?php print $value['notificationID'].'-'.$value['name'];?></option>
                                                    <?php }}?>
                                               </select>
                                            </span>     
                                        </div>      
                                    </div>
                                   <div class="col-md-2" style="text-align:center;">
                                       <a class="btn btn-warning btn-sm active" ng-click="cc.removeCat($index)" href="#" role="button">Delete Rule</a>
                                    </div>
                                </div>
                            </div> 
                        </category>     
                        <div class="row">
                            <div class="col-md-2">
                                <div class="span4 offset4 text-normal">
                                    <a class="btn btn-success btn-sm active" ng-click="mc.addCat()" href="#" role="button">Add Rule</a>
                                </div>
                            </div>    
                        </div> 
                    </div> 
                </div>
        </form>
       
        <br/>
        
        <div class="form-group" style="margin-top: 30px;">
            <div>
                <button class = "appDesSubmit btn btn-primary btn-lg" type="submit"  value="update">Update</button>
            </div>
        </div>
    </div>
</div>
 <script>
	
(function () {
    'use strict';
		angular.module('app').controller('MainCtrl', function($scope) {
			var vm = this;
			vm.main = {
				categories:<?php if(!empty($this->notificationInfo['description'])){print $this->notificationInfo['description'];} else{ print "[{i:'',t:'',n:''}]";}?>
			};
                   
			vm.addCat = function() {
                          
                            var cat = {i:'',t:'',n:''};
                            vm.main.categories.push(cat);
			};
			$scope.$on('delCategory', function(event, index){
				var cats = vm.main.categories;
				cats.splice(index, 1);
			});
			
			$scope.$on('updateItems',function(event,index,pindex){
			  delete vm.main.categories[pindex].items[index];
			});
                    window.category = vm.main.categories;    
		});
        })(); 
;

(function () {
    'use strict';
		angular.module('app').directive('category', function() {
                    return {
                        restrict: 'E',
                        replace: true,
                        controllerAs: 'cc',
                        controller: function ($scope) {
                            var vm = this;

                            vm.removeCat = function(index) {
                                    $scope.$emit('delCategory', index);
                            };
                        }   
                    };
		});
})(); 
;


 </script>  
