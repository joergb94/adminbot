import * as Yup from 'yup'; 
// Locale ES
Yup.setLocale({
    mixed: {
        notType: 'El valor registrado en el campo ${label} es invalido',
        required: 'El campo ${label} es requerido',
        oneOf: 'Seleccione unicamente una de las opciones validas ${values}',
        typeError: 'El valor del ${label} no conincide con el ${values}',
    },
    array: {
        min: 'El campo ${label} debe de tener minimo ${min} registro',
        max: 'El campo ${label} no debe de exceder ${max} registros',
    },
    number: {
        min: 'El campo ${label} debe de tener minimo ${min} ',
        max: 'El campo ${label} no debe de exceder ${max}',
    },
    string: {
        min: 'El campo ${label} debe de tener minimo ${min} characters',
        max: 'El campo ${label} no debe de exceder ${max} characters',
        matches: 'El campo ${label} no cumple con el formato requerido',
    },
    object: {
        shape: {
            name: {
                required: 'Name is required',
            },
        },
    },
});

//--- Nullables Data Types Schemas
export const stringSchema = Yup.string()
    .nullable()
    .transform((value) => {
        return !value ? null : value.trim();
    })
    .min(2);

export const integerSchema = Yup.number()
    .nullable()
    .transform((value, originalValue) => {
        return originalValue === '' ? null : value;
    });

export const floatSchema = Yup.number()
    .nullable()
    .typeError('Invalid float number')
    .transform((value, originalValue) => {
        return originalValue === '' ? null : value;
    })
    .test('is-float', 'Invalid float number', value => {
        if (value === null || value === undefined) return true;
        return !isNaN(value) && value.toString().indexOf('.') !== -1;
    });

// Spesifics Schemas according to the data type nullables
export const upcSchema = stringSchema
    .label('upc')
    .matches(/^[0-9]+$/)
    .min(8)
    .max(15);

//--- Objects
export const objectCodeSchema = { id: integerSchema.required(), name: stringSchema.required(), code: stringSchema.required() };
export const objectSchema = { id: integerSchema.required(), name: stringSchema.required() };
export const objectCodeShapeSchema = Yup.object().shape(objectCodeSchema).nullable();
export const objectShapeSchema = Yup.object().shape(objectSchema).nullable();
export const objectFlow = Yup.object().shape({
                                                id: Yup.number()
                                                .required('El campo ID es requerido')
                                                .positive('El ID debe ser un número positivo')
                                                .integer('El ID debe ser un número entero'),
                                                name: Yup.string()
                                                .required('El campo Nombre es requerido')
                                                .min(3, 'El Nombre debe tener al menos 3 caracteres'),
                                                description: Yup.string()
                                                .required('El campo Descripción es requerido')
                                                .min(5, 'La Descripción debe tener al menos 5 caracteres'),
                                            });
export const arrayShapeSchema = Yup.array().of(objectShapeSchema.required()).nullable();
export const arrayShapeCustomSchema = Yup.array();
export const flowSchema = Yup.array()
                            .label('Pasos')
                            .of(objectFlow)
                            .min(1, 'El ${label} no puede estar vacío')
                            .max(5, 'El ${label} no puede tener más de 5 items')
                            .required('El campo: ${label}, es Requerido');
