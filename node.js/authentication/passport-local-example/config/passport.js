const passport = require('passport');
const User = require('../models/User');
const bcrypt = require("bcryptjs");

const LocalStrategy = require('passport-local').Strategy;

passport.serializeUser(function (user, done) {
    return done(null, user.id);
})

passport.deserializeUser(async function (id, done) {
    try {
        const userObj = await User.findById(id, '-password');
        return done(null, userObj);
    } catch (error) {
        done(error);
    }
})

passport.use(new LocalStrategy({
    passReqToCallback: true,
    usernameField: 'email',
    passwordField: 'password',
}, async function (req, email, password, done) {
    const userObj = await User.findOne({ email: email });
    if (userObj && userObj._id) {
        const match = await bcrypt.compare(password, userObj.password);
        if (match) {
            return done(null, {
                id: userObj._id
            })
        }
    }

    /**
     * Set error message in flash and call the callback.
     */
    req.flash('error', 'Wrong Credentials');
    return done(null, false);
}));


module.exports = passport;