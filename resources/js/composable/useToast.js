import { useToast as primeToast } from 'primevue/usetoast';

const useToast = () => {
    const toast = primeToast();

    function toastRequest(severity, summary, detail) {
        toast.add({ severity: severity, summary: summary, detail: detail, life: 3000 });
    }

    return {
        toastRequest,
    };
};

export default useToast;
