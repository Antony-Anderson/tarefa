import { toast } from 'vue3-toastify';

export default class Toast {
    success(message){
        toast(message, {
            "type": "success",
            "position": "bottom-right",
            "dangerouslyHTMLString": true
        });
    }

    error(message){
        toast(message, {
            "type": "error",
            "position": "bottom-right",
            "dangerouslyHTMLString": true
        });
    }
}