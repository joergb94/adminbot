import { useToast } from 'primevue/usetoast';

const useToastComposable = () => {
    const t = useToast();

    function toast(severity, summary, detail) {
        const msg = detail ? detail : 'Error de Atenticación de Usuario, actualice la pagina o comuniquese con el area de sistemas';
        t.add({ severity: severity, summary: summary, detail: msg, life: 5000 });
    }

    return {
        toast,
    };
};

export default useToastComposable;
