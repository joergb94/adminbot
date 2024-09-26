import { useConfirm } from 'primevue/useconfirm';
import { useToast } from 'primevue/usetoast';

const useConfirmation = () => {
    const confirm = useConfirm();
    const toast = useToast();

    function confirmAction(message, options = {}) {
        return confirm.require({
            message,
            header: options.header || 'Confirmacion.',
            icon: options.icon || 'pi pi-exclamation-triangle',
            acceptLabel: options.acceptLabel || 'Si, Realizar Proceso.',
            rejectLabel: options.rejectLabel || 'No, Cancelar Proceso.',
            accept: options.accept || (() => {}),
            reject:
                options.reject ||
                (() => {
                    toast.add({ severity: 'info', summary: 'Confirmacion.', detail: 'Proceso Cancelado.', life: 1000 });
                }),
            acceptClass: 'p-button-success mt-3',
            rejectClass: 'p-button-secondary mt-3',
        });
    }
    return {
        confirmAction,
    };
};

export default useConfirmation;
