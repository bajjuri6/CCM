<div class="wrapper" layout="column" ng-controller="LeadController" fix-nav ng-init="setupLeads()" >
    
    <div layout layout-align="end center" style="margin-top : 32px;">
        <md-button class="md-button md-hue-2 md-primary" ng-click="addNewLead($event)">New Lead</md-button>
        <md-button class="md-button md-primary md-hue-2" ng-click="expToXl('#ldsTbl')">Export to Excel</md-button>
    </div>
    <table flex id="ldsTbl">
        <tr>
            <th>Customer Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Occupation</th>
            <th>Occupation detail</th>
            <th cols="2">Business detail</th>
            <th>PAN Number</th>
            <th>Aadhaar Number</th>
            <th>Status</th>
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
                <div ng-if="lead.sts == 0">
                    <a href="#" class="_act-btn" ng-click="apprvLd(lead.lid, $index, $event)">Approve</a>
                    <a href="#" class="_act-btn" ng-click="dltLd(lead.lid, $index, $event)">Reject</a>
                </div>
                <div ng-if="lead.sts != 0">
                    <span class="_act-btn">{{lead.sts == 1 ? 'Approved' : 'Rejected'}}</span>
                </div>
            </td>
        </tr>
    </table>
</div>
