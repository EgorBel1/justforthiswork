<div class="wait overlay">
    <div class="loader"></div>
</div>
<style>
    .input-borders {
        border-radius: 30px;
    }
</style>
<div class="container-fluid">
    <!-- Billing Details -->
    <form id="signup_form" onsubmit="return false" class="login100-form">
        <div class="section-title">
            <h2 class="login100-form-title p-b-49">Регистрация</h2>
        </div>
        <div class="form-group">
            <input class="input form-control input-borders" type="text" name="f_name" id="f_name" placeholder="Имя">
        </div>
        <div class="form-group">
            <input class="input form-control input-borders" type="text" name="l_name" id="l_name" placeholder="Фамилия">
        </div>
        <div class="form-group">
            <input class="input form-control input-borders" type="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input class="input form-control input-borders" type="password" name="password" id="password" placeholder="Пароль">
        </div>
        <div class="form-group">
            <input class="input form-control input-borders" type="password" name="repassword" id="repassword" placeholder="Повторите пароль">
        </div>
        <div class="form-group">
            <input class="input form-control input-borders" type="text" name="mobile" id="mobile" placeholder="Телефон">
        </div>
        <div class="form-group">
            <input class="input form-control input-borders" type="text" name="address1" id="address1" placeholder="Адрес">
        </div>
        <div class="form-group">
            <input class="primary-btn btn-block" value="Зарегистрироваться" type="submit" name="signup_button">
        </div>
    </form>
    <div class="login-marg">
        <!-- Billing Details -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" id="signup_msg"></div>
            <!--Alert from signup form-->
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
</div>
