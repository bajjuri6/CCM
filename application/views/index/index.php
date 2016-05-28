<?php ?>
<div class="wrapper" flex layout="column" fix-nav>
  <div layout="column" flex id="lgn-bx" class="popup" ng-controller="LoginController">
      <md-content flex layout="row" layout-align="center center">
          <section flex="40" layout-padding layout="column" class="md-whiteframe-1dp">
              <h2 align="center">Login</h2>
              <div layout layout-align="center center">
                  <form name="lgnForm" flex="80" id="lgnForm" novalidate ng-submit="logIn(lgnForm.$valid)">
                  <div layout="column" flex="100">
                      <md-input-container class="md-block" flex>
                              <label>Username</label>
                              <input id="lgnMblNm" name="lgnMblNm" ng-model="lgnPrms.lgnMblNm" class="_mbl-nm" type="text" required>
                              <div ng-messages="lgnForm.lgnMblNm.$error">
                                  <div ng-message="required" ng-show="lgnForm.lgnMblNm.$error.required">Please enter your username</div>
                              </div>
                          </md-input-container>
                      <md-input-container class="md-block" flex>
                          <label>Password</label>
                          <input id="lgnPwd" name="lgnPwd" ng-model="lgnPrms.lgnPwd" type="password" required>
                          <div ng-messages="lgnForm.lgnPwd.$error">
                              <div ng-message="required" ng-show="lgnForm.lgnPwd.$error.required">Please enter your password</div>
                          </div>
                      </md-input-container>
                      <div layout="row" flex layout-align="center center">
                          <md-button flex-gt-xs="40" flex-xs="100" type="submit" class="md-raised md-primary md-hue-2">Start</md-button>
                      </div>
                    </div>
                </form>
              </div>
          </section>
      </md-content>
  </div>
</div>