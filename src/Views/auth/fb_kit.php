<?php include ROOT . "/src/Views/layouts/header.php"; ?>

<h3 class="text-center">Login with FB</h3>
<div class="text-center">
    <input value="+380" id="country_code"/>
    <input placeholder="phone number" id="phone_number" value="950849032"/>
    <button onclick="smsLogin();">Login via SMS</button>
    <div>OR</div>
    <input placeholder="email" id="email"/>
    <button onclick="emailLogin();">Login via Email</button>
</div>

<form id="login_success" method="post" action="login_success">
    <input id="csrf" type="hidden" name="csrf"/>
    <input id="code" type="hidden" name="code"/>
</form>

<?php include ROOT . "/src/Views/layouts/footer.php"; ?>
