
<div layout="column" layout-align="space-between stretch" class="minhgt" ng-controller="LeadController" >
    <md-content>
        <div layout="column" layout-align="center center">
            <div>
                <div class="md-padding"></div>
                <md-button class="md-raised md-hue-2 md-primary" ng-click="addNewLead($event)">New Lead</md-button>
            </div>

            <div class="md-padding"></div>
            <div>
                <table>
                  <tr>
                      <th>Customer Name</th>
                      <th>Phone Number</th>
                      <th>Address</th>
                      <th>Occupation</th>
                      <th>Occupation detail</th>
                      <th>Business detail</th>
                      <th>PAN Number</th>
                      <th>Aadhaar Number</th>
<!--                      <th></th>-->
                  </tr>

                  <tr ng-repeat='customer in customers'>
                      <td ng-bind="user.name"></td>
                      <td ng-bind="user.phone"></td>
                      <td ng-bind="user.addr"></td>
                      <td ng-bind="user.occupation"></td>
                      <td ng-bind="user.occupationdetail"></td>
                      <td ng-bind="user.biz"></td>
                      <td ng-bind="user.pan"></td>
                      <td ng-bind="user.aadhaar"></td>
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