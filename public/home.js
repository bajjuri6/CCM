var app = angular.module("ccmApp", ['ngMaterial', 'ngMessages']);

app.config(function ($mdThemingProvider) {
    var white = $mdThemingProvider.extendPalette('grey', {
        '400': 'FFFFFF',
        'A400': 'FFFFFF',
        '200': 'CCCCCC',
        'A200': 'CCCCCC'
    });

    $mdThemingProvider.definePalette('white', white);
    $mdThemingProvider.theme('default')
            .primaryPalette('blue', {
                'default': '500'
            })
            .accentPalette('white')
});

/* Services */
app.service('manageUser', function () {
    var $scope = null;
    return {
        set: function (scope) {
            $scope = scope;
        },
        get: function () {
            return $scope;
        }
    }
});

app.service('manageLead', function () {
    var $scope = null;
    return {
        set: function (scope) {
            $scope = scope;
        },
        get: function () {
            return $scope;
        }
    }
});

app.directive('fixNav', function () {
    return {
        restrict: "A",
        link: function (s, e, a) {
            if ($(e).parents('md-dialog').length)
                $(e).parents('md-dialog').addClass('_hid-scrl');
            else
            {
                angular.element(document.getElementById('mainHeader')).addClass('_fix _sticky');
                angular.element(document.querySelector('.wrapper')).addClass('_add-padng');
            }
        }
    }
});
app.directive('ccmHtml', function () {
    return {
        restrict: 'AC',
        scope: {
            "ccmHtml": "="
        },
        link: function (scope, elem, attr) {
            scope.$watch('ccmHtml', function (nt, ot) {
                if (nt != "" && nt)
                {
                    elem.html(nt.replace(/(?:\r\n|\r|\n)/g, '<br />'));
                }
            });
        }
    };
});
app.controller('ToastController', ['$scope', '$mdToast',
    function ($scope, $mdToast) {
        var last = {
            bottom: true,
            top: false,
            left: true,
            right: false
        };

        $scope.tstPos = angular.extend({}, last);
        $scope.getTstPos = function () {
            return Object.keys($scope.tstPos)
                    .filter(function (pos) {
                        return $scope.tstPos[pos]
                    })
                    .join(' ');
        };

        $scope.showActionToast = function (ctnt, scope) {
            var par = document.querySelector('body');
            if (angular.element(par).hasClass('md-dialog-is-showing'))
                par = document.querySelector('.wrapper');
            $mdToast.show({
                hideDelay: 15000,
                controller: 'ToastController',
                template: ctnt,
                scope: scope
            });
        };

        $scope.showSimpleToast = function (text) {
            var par = document.querySelector('body');
            if (angular.element(par).hasClass('md-dialog-is-showing'))
                par = document.querySelector('.wrapper');

            $mdToast.show($mdToast.simple().textContent(text)
                    .position($scope.getTstPos()).hideDelay(4000).parent(par));
        };

        $scope.cancelToast = function () {
            $mdToast.hide();
        };
    }]);



app.controller('DialogController', ['$scope', '$mdDialog', '$mdMedia', function ($scope, $mdDialog, $mdMedia) {
        $scope.customFullscreen = $mdMedia('xs');
        $scope.loadDialog = function (url, elm, clkOutToCls, isFlScrn) {
            var useFullScreen = isFlScrn == undefined ? (($mdMedia('sm') || $mdMedia('xs')) && $scope.customFullscreen) : isFlScrn;
            clkOutToCls = clkOutToCls != undefined ? clkOutToCls : true;
            $mdDialog.show({
                controller: PanelController,
                templateUrl: '/' + url,
                parent: angular.element(document.body),
                targetEvent: elm,
                clickOutsideToClose: clkOutToCls,
                escapeToClose: clkOutToCls,
                fullscreen: useFullScreen
            });
            $scope.$watch(function () {
                return $mdMedia('xs') || $mdMedia('sm');
            }, function (wantsFullScreen) {
                $scope.customFullscreen = (wantsFullScreen === true);
            });
        };

        $scope.loadTextDialog = function (html, ev, clkOutToCls, isFlScrn) {
            var useFullScreen = isFlScrn == undefined ? (($mdMedia('sm') || $mdMedia('xs')) && $scope.customFullscreen) : isFlScrn;
            $mdDialog.show({
                parent: angular.element(document.body),
                targetEvent: ev,
                template: html,
                controller: PanelController,
                clickOutSideToClose: clkOutToCls,
                escapeToClose: clkOutToCls,
                fullscreen: useFullScreen
            });
            $scope.$watch(function () {
                return $mdMedia('xs') || $mdMedia('sm');
            }, function (wantsFullScreen) {
                $scope.customFullscreen = (wantsFullScreen === true);
            });
        };

        $scope.confirmDialog = function (ev, ttl, text, ok, cancel) {
            ok = ok != null ? ok : "Yes";
            cancel = cancel != null ? cancel : "No";
            var confirm = $mdDialog.confirm()
                    .title(ttl).textContent(text)
                    .ariaLabel(text)
                    .targetEvent(ev)
                    .ok(ok).cancel(cancel);
            return $mdDialog.show(confirm);
        };
    }]);

app.controller("BottomSheetController", ['$scope', '$mdBottomSheet', function ($scope, $mdBottomSheet) {
        $scope.showGridBtmSheet = function (url, controller) {
            $scope.alert = '';
            $mdBottomSheet.show({
                templateUrl: '/' + url,
                controller: controller,
                clickOutsideToClose: true
            });
        };
    }]);


function PanelController($scope, $mdDialog) {
    $scope.hide = function () {
        $mdDialog.hide();
    };
    $scope.cancel = function () {
        $mdDialog.cancel();
    };
    $scope.answer = function (answer) {
        $mdDialog.hide(answer);
    };
}

app.controller("LoginController", ["$scope", "CCMAPI", "$controller",
    function ($scope, CCMAPI, $controller) {
        $scope.reqLogin = false;

        $controller('ToastController', {$scope: $scope});

        $scope.logIn = function (isValid) {
            if (isValid)
            {
                CCMAPI.postData(
                        {
                            "id": $scope.lgnPrms.lgnMblNm,
                            "password": $scope.lgnPrms.lgnPwd
                        }, "signin")
                        .success(function (res) {
                            if (res.status) {
                                setTimeout(function () {
                                    window.location = '/leads';
                                }, 1500);
                            }
                            else
                                $scope.showSimpleToast(res.msg);
                        }).error(function (err) {
                    $scope.showSimpleToast("Oh no! Can you please try again");
                });
            } else {
                $scope.showSimpleToast("All fields are required.");
            }
        };

    }]);

app.controller("UserController", ["$scope", "CCMAPI", "$controller", "manageUser",
    function ($scope, CCMAPI, $controller, manageUser) {
        $controller('ToastController', {$scope: $scope});
        $controller('DialogController', {$scope: $scope});

        $scope.addNewUser = function (event) {
            $scope.loadDialog('newuser', event, true);
        }

        $scope.saveUser = function (isValid) {
            if (isValid) {
                CCMAPI.postData($scope.usr, "saveuser")
                        .success(function (res) {
                            if (res.status) {
                            }
                            else
                                $scope.showSimpleToast(res.msg);
                        }).error(function (err) {
                    $scope.showSimpleToast("Oh no! Can you please try again");
                });
            }
        }

        $scope.getUsers = function () {
            CCMAPI.postData({}, "getusers")
                    .success(function (res) {
                        if (res.status) {
                            $scope.users = res.msg;
                        }
                        else
                            $scope.showSimpleToast(res.msg);
                    }).error(function (err) {
                $scope.showSimpleToast("Oh no! Can you please try again");
            });
        }

        $scope.loadUserDialog = function () {
            var parScope = manageUser.get();
            $scope.usr = parScope.usr;
        };


        $scope.status = {"1": "Active", "0": "Suspended", "-1": "Deleted"};
        $scope.lvl = {"1": "Partner", "2": "CCM Employee", "4": "Manager", "8": "Admin"};


        $scope.loadUsersPage = function () {
            $scope.getUsers();
            manageUser.set($scope);
        }

        $scope.editUser = function (indx, event) {
            $scope.usr = $scope.users[indx];
            $scope.loadDialog('newuser', event, false);
        };
    }]);

app.controller("LeadController", ["$scope", "CCMAPI", "$controller", "manageLead",
    function ($scope, CCMAPI, $controller, manageLead) {
        var self = this;
        $controller('ToastController', {$scope: $scope});
        $controller('DialogController', {$scope: $scope});

        $scope.setupLeads = function () {
            CCMAPI.postData({}, "gtlds").success(function (res) {
                if (res.status == 1)
                    $scope.leads = res.msg;
            });

            manageLead.set($scope);
        };

        $scope.cust = {
            "biz": {cards: "y", sales: "", since: "", premises: "", nature: "", phone: ""}
        };

        self.cstOcp = [[{name: "Proprietary company", val: 4}, {name: "Partnership Company", val: 5}, {name: "Private Limited Company", val: 6}], [{name: "Proprietary Company", val: 7}, {name: "Private Limited Company", val: 8}, {name: "Government", val: 9}], [{name: "Doctor", val: 10}, {name: "Architect", val: 11}, {name: "CA", val: 12}]];

        $scope.$watch('cust.occupation', function (nv, ov) {
            if (nv != ov && nv)
            {
                $scope.subOcp = self.cstOcp[parseInt(nv) - 1];

                if (nv == 1)
                    $scope.cust.biz.cards = 'y';
                else
                    $scope.cust.biz.cards = 'n';
            }
        });

//        self.setSubOcp = function () {
//            console.log(cust);
//            return self.cstOcp[parseInt($scope.cust.occupation) + 1];
//        };

        $scope.setOcpt = function (typ) {
            return typ == 1 ? "Self Employed" : (typ == 2 ? "Employee" : "Professional");
        };

        $scope.setSubOcpt = function (ocpTyp, subOcpTyp) {
            var subOcpt = self.cstOcp[ocpTyp - 1];
            var txt = '';
            for (var s = 0; s < subOcpt.length; s++)
            {
                if (subOcpt[s]['val'] == parseInt(subOcpTyp))
                {
                    txt = subOcpt[s]['name'];
                    break;
                }
            }

            return txt;
        };

        $scope.bldBizTxt = function (indx) {
            var lead = $scope['leads'][indx];
            if (lead.occupation == 1)
            {
                var biz = typeof lead['biz'] == 'string' ? JSON.parse(lead['biz']) : lead['biz'];
                return "<span>Accepts Cards : " + (biz.cards == 'y' ? "Yes" : "No") + "</span><br>" +
                        "<span>Monthly Card Sales : " + (biz.sales) + "</span><br>" +
                        "<span>PoS Business Since: " + (biz.since) + "</span><br>" +
                        "<span>Business Premises : " + (biz.premises == 1 ? "Owned" : "Rented") + "</span><br>" +
                        "<span>Nature of Business : " + (biz.nature) + "</span><br>" +
                        "<span>Business Phone : " + biz.phone + "</span><br>";
            }
            else
                return "";
        };



        self.parScope = null;
        $scope.addNewLead = function (event) {
            $scope.loadDialog('newlead', event, true);
        };

        $scope.setupLeadForm = function () {
            self.parScope = manageLead.get();
        };

        $scope.saveLead = function (isValid) {
            if (isValid)
            {
                CCMAPI.postData($scope.cust, "adld").success(function (res) {
                    if (res.status == 1)
                    {
                        self.parScope.leads.push($scope.cust);
                        $scope.cancel();
                    }
                    else
                        $scope.showSimpleToast("Something is not right here. Please try again!");
                });
            }
        };

        $scope.apprvLd = function (id, indx, ev) {
            ev.preventDefault();
            $scope.confirmDialog(ev, "Confirmation Required", 'Please click "Approve" button to confirm', "Approve", "Cancel").then(function () {
                CCMAPI.postData({id: id}, "aprvld").success(function () {
                    $scope.showSimpleToast("Approved");
                    angular.element(ev.currentTarget).remove();
                });
            });
        };

        $scope.dltLd = function (id, indx, ev) {
            ev.preventDefault();
            $scope.confirmDialog(ev, "Delete Confirmation Required", 'Please click "Continue" button to confirm', "Continue", "Cancel").then(function () {
                CCMAPI.postData({id: id}, "dltld").success(function (res) {
                    if (res.status == 1) {
                        $scope.showSimpleToast("Deleted");
                        $scope.leads.splice(indx, 1);
                    }
                });
            });
        };

    }]);
app.factory('CCMAPI', ['$http', function ($http) {

        $http.defaults.headers.post["Content-Type"] = 'application/x-www-form-urlencoded; charset=utf-8';
        var CCMData = {};

        CCMData.postData = function (data, url) {
            return $http({
                method: 'POST',
                url: '/' + url,
                data: $.param(data)
            });
        };

        CCMData.getData = function (url, data) {
            var getParams = Object.keys(data).map(function (param) {
                return encodeURIComponent(param) + '=' + encodeURIComponent(data[param]);
            }).join('&');
            return $http({
                method: 'GET',
                url: '/' + url + '?' + getParams
            });
        };
        return CCMData;

    }]);
