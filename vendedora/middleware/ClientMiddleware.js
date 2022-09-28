export default (context) => {
    if (context.$auth.loggedIn) {
        if (context.$auth.user.type == 1) {
            return context.redirect('/admin/home')
        }
    } else {
        return context.redirect('/')
    }
}