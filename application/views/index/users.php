<div class="wrapper" fix-nav layout="column" ng-controller="UserController" ng-init="loadUsersPage()">
    <md-content layout="column" flex>
        <div layout layout-align="center center" layout-margin>
            <md-button class="md-raised md-hue-2 md-primary" ng-click="addNewUser($event)">Add New User</md-button>
        </div>
        <table>
            <tr>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
                <th>Privilege Level</th>
                <th></th>
            </tr>

            <tr ng-repeat='user in users'>
                <td ng-bind="user.name"></td>
                <td ng-bind="user.phone"></td>
                <td ng-bind="user.email"></td>
                <td ng-bind="user.addr"></td>
                <td ng-bind="status[user.status]"></td>
                <td ng-bind="lvl[user.lvl]"></td>
                <td>
                    <div ng-if="user.status == 0">
                        <a class="_act-btn" href="#" ng-click="aprvUsr(user.uid, $index, $event)">Approve</a>
                        <a class="_act-btn" href="#" ng-click="dltUsr(user.uid, $index, $event)">delete</a>  
                    </div>
                    <div ng-if="user.status != 0">
                        <span class="_act-btn">{{user.status == 1 ? 'Approved' : 'Rejected'}}</span>
                    </div>
                </td>
            </tr>
        </table>
    </md-content>
</div>