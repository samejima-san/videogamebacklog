//get password and confirm password from html form
const password = req.body.password;
const confirmPassword = req.body.confirmPassword;

//if confirm password is not same as password
if (password !== confirmPassword) {
    return res.status(422).json({
        error: "Confirm password does not match with password",
    });
}