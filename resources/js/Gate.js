export default class Gate{

    constructor(user){
        this.user = user;
    }

    isSuperAdmin(){
        return this.user.type === 'superadmin';
    }

    isAdmin(){
        return this.user.type === 'admin';
    }
    
    isManager(){
        return this.user.type === 'manager';
    }

    isUserA(){
        return this.user.type === 'userA';
    }

    isUserB(){
        return this.user.type === 'userB';
    }
    
}

