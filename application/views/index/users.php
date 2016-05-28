<div layout="column" layout-align="space-between stretch" class="minhgt" ng-controller="UserController" ng-init="loadUsersPage()">
    <md-content>
        <div layout="column" layout-align="center center">
	        <div>
	        	<div class="md-padding"></div>
	            <md-button class="md-raised md-hue-2 md-primary" ng-click="addNewUser($event)">Add New User</md-button>
	        </div>
	        
	        <div class="md-padding"></div>
	        <div>
	            <table>
                  <tr>
	                    <th>Full Name</th>
                      <th>CCM ID</th>
                      <th>Phone Number</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Privilege Level</th>
<!--                      <th></th>-->
	                </tr>
                  
	                <tr ng-repeat='user in users'>
	                    <td ng-bind="user.name"></td>
                      <td ng-bind="user.id"></td>
                      <td ng-bind="user.phone"></td>
                      <td ng-bind="user.email"></td>
                      <td ng-bind="user.addr"></td>
                      <td ng-bind="status[user.status]"></td>
                      <td ng-bind="lvl[user.lvl]"></td>
<!--	                    <td>
                          <a href="" ng-click="editUser($index, $event)">suspend</a>
                          <a href="">delete</a>
                          <a href="" ng-click="editUser($index, $event)">edit</a>
                      </td>-->
	                </tr>
	            </table>
	        </div>
        </div>
        <div class="md-padding"></div>
    </md-content>
</div>