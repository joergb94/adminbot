import * as yup from 'yup';
import { stringSchema } from '@/utils/yupCommon';

const registerShapeSchema =yup.object().shape({
                        name: stringSchema.label('Nombre').max(100).required(),
                        first_name: stringSchema.label('Paterno').max(100).required(),
                        last_name: stringSchema.label('Materno').max(100).required(),
                        phone_number: stringSchema.label('Número de Telefono').max(10).required(),
                        email: yup
                            .string()
                            .required('El correo electronico es requerido')
                            .min(10, 'El correo debe tener al menos 10 caracteres')
                            .email('Por favor, introduzca un correo electrónico válido.')
                            .max(100, 'No puede ser tan largo'),
                        password: yup
                            .string()
                            .required('La contrasena es requerida')
                            .min(8, 'La contrasena debe tener al menos 8 caracteres')
                            .max(100, 'No puede ser tan largo'),
                        password_confirmation: yup
                            .string()
                            .required('La contrasena es requerida')
                            .min(8, 'La contrasena debe tener al menos 8 caracteres')
                            .max(100, 'No puede ser tan largo'),
                    });
export default registerShapeSchema;
