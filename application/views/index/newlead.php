<div class="wrapper popup" layout layout-align="center stretch" ng-controller="LeadController" >
  <div layout="column" layout-align="space-between stretch" class="minhgt" >
      <md-content style="overflow: auto">
    <form name="leadsfrm" >
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
        <md-input-container ng-init="group='self'" class="md-block" >
            <md-select  name="occupation" required ng-model="cust.occupation" >
                <md-option  value="1">Self Employed</md-option>
                <md-option  value="2">Employee</md-option>
                <md-option  value="3">Professional</md-option>
            </md-select>
        </md-input-container>
        <md-input-container ng-init="group='self'" class="md-block">
            <md-select  name="occupationdetail" md-on-open="loadOccupationDetail($event)" required ng-model="cust.occupationdetail" >
                <md-option ng-repeat="detail in details" value="1">Self Employed</md-option>
            </md-select>
        </md-input-container>
        <div layout="column">
            <div layout="column" ng-show="group == 'self'">
                <md-radio-group ng-model="cust.selftype" class="md-padding md-primary">
                    <md-radio-button value="Proprietary" >Proprietary company</md-radio-button>
                    <md-radio-button value="Partnership"> Partnership company </md-radio-button>
                    <md-radio-button value="Private">Private Limited company</md-radio-button>
                </md-radio-group>
                <label class="lable_clr">Does the customers accept cards?</label>
                <md-input-container ng-init="yes_no='Yes'">
                    <md-radio-group  ng-model="cust.biz.cards" layout class="md-primary">
                        <md-radio-button value="Yes" >Yes</md-radio-button>
                        <md-radio-button value="No">No</md-radio-button>
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
                <div layout="column" flex>
                <label class="lable_clr">Business Premises</label>
                <md-input-container ng-init="Owned_Rented='Owned'"  >
                    <md-radio-group layout ng-model="cust.biz.premises" class="md-primary">
                        <md-radio-button value="1" >Owned</md-radio-button>
                        <md-radio-button value="2">Rented</md-radio-button>
                    </md-radio-group>
                </md-input-container>
                </div>
                <md-input-container class="md-block">
                    <label>Nature of Business</label>
                    <input type="text"  required  name="nature_of_business" ng-model="cust.biz.nature">
                    <div ng-messages="leadsfrm.nature_of_business.$error">
                        <div ng-message="required">Nature of Business is required.</div>
                    </div>  
                </md-input-container>
                <md-input-container class="md-block">
                    <label>Business Phone Number</label>
                    <input type="text"  required  name="business_phn" ng-model="cust.biz.phone">
                    <div ng-messages="leadsfrm.business_phn.$error">
                        <div ng-message="required">Business Pohne Number is required.</div>
                    </div>  
                </md-input-container>
            </div>

        </div>
        <md-input-container flex-gt-sm class="md-block" >
            <label>Customers Annual Income (lacs per month)</label>
            <md-select  name="customer_Annual_Income" required ng-model="cust.income" >
                <md-option  value="0-5">0-5</md-option>
                <md-option  value="5-10">5-10</md-option>
                <md-option  value="10-25">10-25</md-option>
                <md-option  value="25-50">25-50</md-option>
                <md-option  value=">50">>50</md-option>
            </md-select>
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
            <md-button type="submit" class="md-raised md-accent">Submit Lead</md-button>
        </md-input-container>
    </form>
          </md-content>
  </div>
</div>