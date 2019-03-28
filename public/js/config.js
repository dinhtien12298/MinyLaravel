let config = {
    base: "http://miny.laravel/",
    searchSubjects: "nguoi-dung/tim-chu-de/",
    deletePost: "nguoi-dung/xoa-bai/",
    searchTab: "tim-kiem-tab/",
    searchPosts: "tim-kiem-bai-viet/"
}

let proxy = new Proxy(config, {
    get(target, name, receiver) {
        if(!name.match(/^_/)){
            return Reflect.get(target, name);
        }else{
            name = name.replace(/^_/, "");
            return Reflect.get(target, 'base').replace(/\/$/, "") + "/" + Reflect.get(target, name);
        }
    }
});