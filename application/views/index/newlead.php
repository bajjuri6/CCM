<div class="wrapper popup" layout layout-align="center stretch" ng-controller="LeadController as lc" >
    <div flex layout-padding>
        <md-content>
            <form name="leadsfrm" novalidate ng-submit="saveLead(leadsfrm.$valid)">
                <md-input-container  class="md-block">
                    <label>Customer Name</label>
                    <input type="text"  required  name="customer_name" ng-model="cust.name">
                    <div ng-messages="leadsfrm.customer_name.$error">
                        <div ng-message="required">Customer's name is required.</div>
                    </div>  
                </md-input-container>
                <md-input-container  class="md-block">
                    <label>Customer Phone Number</label>
                    <input type="text"  required  name="customer_name" ng-model="cust.phone">
                    <div ng-messages="leadsfrm.customer_name.$error">
                        <div ng-message="required">Customer's phone number is required.</div>
                    </div>  
                </md-input-container>
                <md-input-container class="md-block">
                    <label>Customer Address</label>
                    <input type="text"  required  name="customer_addr" ng-model="cust.addr">
                    <div ng-messages="leadsfrm.customer_addr.$error">
                        <div ng-message="required">Customer's address is required.</div>
                    </div>  
                </md-input-container>
                <label class="lable_clr" >Customer Occupation</label>
                <div layout-gt-xs="row" layout="column" layout-align="start stretch" layout-align-gt-xs="space-between center">
                    <md-input-container class="md-block" flex flex-gt-xs="45" >
                        <md-select  name="occupation" required ng-model="cust.occupation">
                            <md-option value="0" ng-selected="true">Select</md-option>
                            <md-option  value="1">Self Employed</md-option>
                            <md-option  value="2">Employee</md-option>
                            <md-option  value="3">Professional</md-option>
                        </md-select>
                    </md-input-container>
                    <md-input-container ng-init="group = 'self'" class="md-block" flex flex-gt-xs="45">
                        <md-select  name="occupationdetail" md-on-open="loadOccupationDetail($event)" required ng-model="cust.occupationdetail" >
                            <md-option ng-repeat="ocp in subOcp" value="{{ocp.val}}" ng-selected="$index == 0" ng-bind="ocp.name"></md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <div ng-if="cust.occupation == 1">
                    <div layout="column">
                        <label class="lable_clr">Does the customers accept cards?</label>
                        <md-input-container>
                            <md-radio-group  ng-model="cust.biz.cards" layout class="md-primary">
                                <md-radio-button class="md-checked" value="y" >Yes</md-radio-button>
                                <md-radio-button value="n">No</md-radio-button>
                            </md-radio-group>
                        </md-input-container>
                        <md-input-container class="md-block">
                            <label>Monthly Card Sales</label>
                            <input type="text"  required  name="sales" ng-model="cust.biz.sales">
                            <div ng-messages="leadsfrm.sales.$error">
                                <div ng-message="required">Monthly Card Sales is required.</div>
                            </div>  
                        </md-input-container>
                        <md-input-container class="md-block">
                            <label>PoS Business Since</label>
                            <input type="text"  required  name="pos_business" ng-model="cust.biz.since">
                            <div ng-messages="leadsfrm.pos_business.$error">
                                <div ng-message="required">PoS Business Since is required.</div>
                            </div>  
                        </md-input-container>

                        <label class="lable_clr">Business Premises</label>
                        <md-input-container ng-init="Owned_Rented = 'Owned'" clas="md-block">
                            <md-radio-group layout ng-model="cust.biz.premises" class="md-primary">
                                <md-radio-button value="1" >Owned</md-radio-button>
                                <md-radio-button value="2">Rented</md-radio-button>
                            </md-radio-group>
                        </md-input-container>
                        
                        <md-input-container class="md-block">
                            <label>Nature of Business</label>
                            <input type="text"  required  name="nature_of_business" ng-model="cust.biz.nature">
                            <div ng-messages="leadsfrm.nature_of_business.$error">
                                <div ng-message="required">Nature of Business is required.</div>
                            </div>  
                        </md-input-container>
                        <md-input-container class="md-block">
                            <label>Business Phone Number</label>
                            <input type="tel"  required  name="business_phn" ng-model="cust.biz.phone">
                            <div ng-messages="leadsfrm.business_phn.$error">
                                <div ng-message="required">Business Pohne Number is required.</div>
                            </div>  
                        </md-input-container>
                    </div>
                </div>
                <md-input-container class="md-block" style="margin-bottom : 32px;">
                    <label>Customers Annual Income (lacs per month)</label>
                    <md-select name="customer_Annual_Income" required ng-model="cust.income" >
                        <md-option  value="0-5">0-5</md-option>
                        <md-option  value="5-10">5-10</md-option>
                        <md-option  value="10-25">10-25</md-option>
                        <md-option  value="25-50">25-50</md-option>
                        <md-option  value=">50">>50</md-option>
                    </md-select>
                    <div ng-messages="leadsfrm.customer_Annual_Income.$error" ng-show="leadsfrm.customer_Annual_Income.$touched && leadsfrm.customer_Annual_Income.$invalid">
                        <div ng-mesage="required">Customer's Annual Income is required</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block">
                    <label>Customer PAN Number</label>
                    <input type="text" required name="customer_pan" ng-model="cust.pan">
                    <div ng-messages="leadsfrm.customer_pan.$error">
                        <div ng-message="required">Customer PAN Number is required.</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block">
                    <label>Customer Aadhaar Number</label>
                    <input type="text"  required name="customer_aadhaar" ng-model="cust.aadhaar">
                    <div ng-messages="leadsfrm.customer_aadhaar.$error">
                        <div ng-message="required">Customer Aadhaar Number is required.</div>
                    </div>
                </md-input-container>
                <md-input-container layout layout-align="center center">
                    <md-button type="submit" class="md-raised md-primary md-hue-2">Submit Lead</md-button>
                    <md-button type="submit" ng-click="cancel()" class="md-raised md-accent md-hue-1">Cancel</md-button>
                </md-input-container>
            </form>
        </md-content>
    </div>
</div>