export default (context) => {
    if (context.$auth.loggedIn) {
        return context.redirect('/home')
    }
}