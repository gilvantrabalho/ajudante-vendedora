export default (context) => {
    if (context.$auth.loggedIn) {
        if (context.$auth.user && context.$auth.user.type == 0) {
            return context.redirect('/home')
        }
    } else {
        return context.redirect('/')
    }
}