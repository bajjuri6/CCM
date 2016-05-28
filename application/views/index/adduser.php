<div class="wrapper popup" layout layout-align="center stretch" ng-controller="UserController" ng-init="loadUserDialog()">
  <div layout="column" layout-align="space-between stretch" class="minhgt">
      <md-content style="overflow: auto">
          <div layout="column" layout-align="center center">
            <div class="lgn" layout-padding >
                <form name="empfrm" ng-submit="saveUser(empfrm.$valid)" >
                    <md-input-container class="md-block">
                        <label>Full Name</label>
                        <input type="text" required  name="name" ng-model="usr.name">
                        <div ng-messages="empfrm.name.$error">
                            <div ng-message="required">Full Name is required.</div>
                            <div ng-message="md-maxlength">The username has to be less than 30 characters long.</div>
                        </div>  
                    </md-input-container>
                    <md-input-container class="md-block">
                        <label>Username</label>
                        <input type="text" md-maxlength="30" required  name="usr_name" ng-model="usr.id">
                        <div ng-messages="empfrm.usr_name.$error">
                            <div ng-message="required">Username is required.</div>
                            <div ng-message="md-maxlength">The username has to be less than 30 characters long.</div>
                        </div>  
                    </md-input-container>
                    <md-input-container class="md-block">
                        <label>Password</label>
                        <input type="password" required  name="password" ng-model="usr.password">
                        <div ng-messages="empfrm.password.$error">
                            <div ng-message="required">Password is required.</div>
                        </div>  
                    </md-input-container>
                    
                    <md-input-container class="md-block">
                        <label>Email</label>
                        <input required type="email" name="email" ng-model="usr.email"/>
                        <div ng-messages="empfrm.email.$error" role="alert">
                          <div ng-message-exp="['required', 'minlength', 'maxlength', 'pattern']">
                            Your email must be between 10 and 100 characters long and look like an e-mail address.
                          </div>
                        </div>
                    </md-input-container>
                    <md-input-container class="md-block">
                        <label>Phone Number</label>
                        <input type="tel"  required name="phone" ng-model="usr.phone">
                        <div ng-messages="empfrm.phone.$error">
                            <div ng-message="required">phone number is required.</div>
                        </div>
                    </md-input-container>
                    <md-input-container class="md-block">
                        <label>Address</label>
                        <textarea name="addr" ng-model="usr.addr" rows="3"></textarea>
                        <div ng-messages="empfrm.addr.$error">
                        </div>
                    </md-input-container>
<!--                    <md-input-container class="md-block">
                        <label>Region</label>
                        <md-select name="region" required ng-model="usr.region" >
                          <md-option  value="Partner">North</md-option>
                          <md-option  value="Employee">South</md-option>
                          <md-option  value="Manager">East</md-option>
                          <md-option  value="Manager">West</md-option>
                        </md-select>
                        </div>
                    </md-input-container>-->
                    <md-input-container flex="100">
                        <label>Level</label>
                        <md-select name="level" required ng-model="usr.lvl" >
                          <md-option  value="1">Partner</md-option>
                          <md-option  value="2">Employee</md-option>
                          <md-option  value="4">Manager</md-option>
                        </md-select>
                    </md-input-container>
                    <md-input-container layout layout-align="center center">
                        <md-button type="submit" class="md-raised md-hue-2 md-primary">Save</md-button>
                    </md-input-container>
                </form>
            </div>
      </md-content>
  </div>
</div>