<div class="wrapper" layout="column" ng-controller="LeadController" fix-nav ng-init="setupLeads()" >
    <div layout="column" layout-align="center center">
        <div>
            <div class="md-padding"></div>
            <md-button class="md-raised md-hue-2 md-primary" ng-click="addNewLead($event)">New Lead</md-button>
        </div>
        
        <table flex>
            <tr>
                <th>Customer Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Occupation</th>
                <th>Occupation detail</th>
                <th cols="2">Business detail</th>
                <th>PAN Number</th>
                <th>Aadhaar Number</th>
                <th></th>
            </tr>

            <tr ng-repeat='lead in leads' id="{{lead.lid}}">
                <td ng-bind="lead.name"></td>
                <td ng-bind="lead.phone"></td>
                <td ng-bind="lead.addr"></td>
                <td ng-bind="setOcpt(lead.occupation)"></td>
                <td ng-bind="setSubOcpt(lead.occupation, lead.occupationdetail)"></td>
                <td cols="2" ccm-html="bldBizTxt($index)"></td>
                <td ng-bind="lead.pan"></td>
                <td ng-bind="lead.aadhaar"></td>
                <td>
                    <a href="#" class="_act-btn" ng-click="apprvLd(lead.lid, $index, $event)">Approve</a>
                    <a href="#" class="_act-btn" ng-click="dltLd(lead.lid, $index, $event)">Reject</a>
                </td>
            </tr>
        </table>
    </div>
</div>
