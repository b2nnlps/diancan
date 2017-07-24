$(function () {
    H_login = {};
    H_login.openLogin = function(){
        $('.login-header a').click(function(){
            $('.login').show();
            $('.login-bg').show();
        });
		 $('.login-header-one a').click(function(){
            $('.login-one').show();
            $('.login-bg').show();
        });
    };
    H_login.closeLogin = function(){
        $('.close-login').click(function(){
            $('.login').hide();
            $('.login-bg').hide();
        });
		 $('.close-login').click(function(){
            $('.login-one').hide();
            $('.login-bg').hide();
        });
    };
    H_login.run = function () {
        this.closeLogin();
        this.openLogin();
        // this.loginForm();
    };
    H_login.run();
});
