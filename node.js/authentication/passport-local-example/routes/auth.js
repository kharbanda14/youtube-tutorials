var express = require('express');
var router = express.Router();
const bcrypt = require('bcryptjs');

const user = require('../models/User');

router.get('/login', function (req, res) {
    const data = {};

    data.title = 'Login';
    data.errors = req.flash('error');

    res.render('auth/login', data);
});
router.get('/signup', function (req, res) {
    const data = {};

    data.title = 'Signup';
    data.errors = req.flash('error');

    res.render('auth/signup', data);
});


router.post('/signup', async function (req, res, next) {

    const body = req.body;

    if (body.email) {
        const existing = await user.findOne({ email: body.email }).countDocuments();
        
        if (existing) {
            req.flash('error', 'User Already Exists');
            return res.redirect('/auth/signup');
        }

        const salt = await bcrypt.genSalt(10);
        body.password = await bcrypt.hash(body.password, salt);

        try {            
            const newUser = new user(body);
            await newUser.save();
            
            req.logIn(newUser, function () {
                res.redirect('/home');
            });
        } catch (error) {
            next(error);
        }
    }    
})


module.exports = function (passport) {

    router.post('/login', passport.authenticate('local', {
        failureRedirect: '/auth/login',
    }), async function (req, res) {
        res.redirect('/home')
    })


    return router;
};