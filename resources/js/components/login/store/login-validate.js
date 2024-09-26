import * as yup from 'yup';

const loginShapeSchema =yup.object().shape({
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
                            // .matches(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/, 'Debe contener 8 caracteres, una mayúscula, una minúscula, un número y un caracter especial')
                            .max(100, 'No puede ser tan largo'),
                    });
export default loginShapeSchema;
