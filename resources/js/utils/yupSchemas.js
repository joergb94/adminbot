import * as Yup from 'yup';

export const idSchema = Yup.number().label('id').required('El ${label} es requerido');

export const productIdSchema = Yup.number()
    .label('Id del producto')
    .required('El ${label} es requerido')
    .typeError('El valor del ${label} debe de ser numerico');

export const nameSchema = Yup.string()
    .label('nombre')
    .required('El ${label} es Requerido')
    .min(2, 'El ${label} es muy corto')
    .max(200, 'El ${label} es muy largo');

export const skuSchema = Yup.string()
    .label('sku')
    .required('El ${label} es Requerido')
    .min(2, 'El ${label} es muy corto')
    .max(200, 'El ${label} es muy largo');

export const upcSchema = Yup.string()
    .label('upc')
    .matches(/^[0-9]{8,15}$/g, 'El código ${label}  debe tener 8 - 15 números')
    .required('El código UPC es Requerido');

export const partNumberSchema = Yup.string()
    .label('numero de parte')
    .min(5, 'El ${label}  debe ser mayor a 5 caracteres')
    .max(50, 'La longitud de caracteres máxima del ${label}  es 50')
    .required('El ${label} es Requerido');

export const zipCodeSchema = Yup.string()
    .label('numero de parte')
    .min(5, 'El ${label}  debe ser mayor a 5 caracteres')
    .max(50, 'La longitud de caracteres máxima del ${label}  es 50')
    .required('El ${label} es Requerido');

export const satCodeSchema = Yup.string()
    .label('clave SAT')
    .matches(/^\d{8}$/, 'El ${label}  debe ser un número de 8 dígitos')
    .required('El ${label}  es Requerido');

export const priceSchema = Yup.number()
    .label('precio')
    .typeError('El valor del ${label} debe de ser numerico')
    .required('Es Requerido')
    .min(0.1, 'debe ser mayor que 0.1')
    .max(999999, 'El numero maximo de digitos para el ${label} de numero debe ser 6');

export const suggestedSchema = Yup.number()
    .label('precio sugerido')
    .typeError('El valor del ${label} debe de ser numerico')
    .max(999999, 'El numero maximo de digitos para el ${label} de numero debe ser 6');

export const qtySchema = Yup.number()
    .label('cantidad')
    .typeError('El valor del ${label} debe de ser numerico')
    .required('Es Requerido')
    .max(999999, 'El numero maximo de digitos para el ${label} de numero debe ser 6');

export const currencySchema = Yup.string()
    .label('Divisa')
    .required('Es Requerido')
    .min(3, 'El campo: ${label} debe tener como minimo 3 caracteres')
    .max(3, 'El campo: ${label} debe tener como máximo 3 caracteres');

export const exchangerateSchema = Yup.number()
    .label('Tipo de Cambio')
    .typeError('El valor del ${label} debe de ser numerico')
    .required('Es Requerido')
    .max(999999, 'El numero maximo de digitos para el ${label} de numero debe ser 6');

export const promotionPriceSchema = Yup.number().label('Precio de promoción').typeError('El valor del ${label} debe de ser numerico');

export const idCodeObjectSchema = Yup.object()
    .shape({ id: Yup.number().required(), code: Yup.string().required() })
    .default(null)
    .nullable()
    .required('Seleccione una moneda');

export const profitPercentageSchema = Yup.number()
    .typeError('El valor debe de ser numerico')
    .required('Es Requerido')
    .min(0.1, 'No puede ser cero')
    .max(1000, 'El maximo debe de ser de 1000');

export const zeroProfitPercentageSchema = Yup.number()
    .typeError('El valor debe de ser numerico')
    .required('Es Requerido')
    .min(0, 'Puede ser 0')
    .max(1000, 'El maximo debe de ser de 1000');

export const rfcSchema = Yup.string()
    .label('rfc')
    .max(13, 'El campo: ${label} debe tener como máximo 13 caracteres')
    .required('El campo: ${label}, es Requerido');

export const addressNumberschema = Yup.string().label('numero exterior').required('El campo: ${label}, es Requerido');

export const referenceSchema = Yup.string()
    .label('Referencia')
    .max(255, 'El campo: ${label} debe tener como máximo 255 caracteres')
    .required('El campo: ${label}, es Requerido');

export const streetSchema = Yup.string()
    .label('Direccion fiscal')
    .max(255, 'El campo: ${label} debe tener como máximo 255 caracteres')
    .required('El campo: ${label}, es Requerido');

export const emailSchema = Yup.string()
    .label('Correo Electronico')
    .email('Ingresa un correo electrónico válido')
    .required('El campo: ${label}, es Requerido');

export const productRelationObjectSchema = Yup.array()
    .of(
        Yup.object().shape({
            product_provider_provider_id: idSchema,
        })
    )
    .required('El campo: ${label}, es Requerido')
    .min(1, 'Debe agregar al menos un producto');

export const urlSchema = Yup.string()
    .nullable()
    .matches(/^(https:\/\/)[a-zA-Z0-9-.]+\.[a-zA-Z]{2,}(\/\S*)?$/, 'Sitio web invalido');

export const observationSchema = Yup.string()
    .label('Observaciones')
    .max(255, 'El campo: ${label} debe tener como máximo 255 caracteres')
    .required('El campo: ${label}, es Requerido');

//--- Objects
const objectSchema = { id: idSchema, name: nameSchema };

export const providerObjectSchema = Yup.object().label('proveedor').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const storeObjectSchema = Yup.object().label('tienda').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const brandObjectSchema = Yup.object().label('marca').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const classificationObjectSchema = Yup.object().label('clasificación').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const currencyObjectSchema = Yup.object().label('moneda').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const countryObjectSchema = Yup.object().label('pais').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const stateObjectSchema = Yup.object().label('estado').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const municipalityObjectSchema = Yup.object().label('municipio').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const neighbourhoodObjectSchema = Yup.object().label('colonia').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const taxRegimeObjectSchema = Yup.object().label('regimen fiscal').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const productObjectSchema = Yup.object().label('producto').shape(objectSchema).required('El campo: ${label}, es Requerido');

export const productPackagingObjectSchema = Yup.object()
    .label('empaquetado de producto')
    .shape(objectSchema)
    .required('El campo: ${label}, es Requerido');

//--- attibutes Objects
const attributeObjectSchema = { id: idSchema };

export const modelObjectSchema = Yup.object().label('Modelo').shape(attributeObjectSchema).required('El campo: ${label}, es Requerido');

export const variantObjectSchema = Yup.object().label('Variante').shape(attributeObjectSchema).required('El campo: ${label}, es Requerido');

export const productTypeObjectSchema = Yup.object()
    .label('tipo de producto')
    .shape(attributeObjectSchema)
    .required('El campo: ${label}, es Requerido');

//--- attibutes array Objects
export const characteristic1ArrayObjectSchema = Yup.array()
    .label('caracteriztica 1')
    .of(Yup.object().shape(attributeObjectSchema))
    .min(1, 'El ${label} no puede estar vacío')
    .max(5, 'El ${label} no puede tener mas de 5 items')
    .required('El campo: ${label}, es Requerido');

export const characteristic2ArrayObjectSchema = Yup.array()
    .label('caracteriztica 2')
    .of(Yup.object().shape(attributeObjectSchema))
    .min(1, 'El ${label} no puede estar vacío')
    .max(5, 'El ${label} no puede tener mas de 5 items')
    .required('El campo: ${label}, es Requerido');

export const characteristic3ArrayObjectSchema = Yup.array()
    .label('caracteriztica 3')
    .of(Yup.object().shape(attributeObjectSchema))
    .min(1, 'El ${label} no puede estar vacío')
    .max(5, 'El ${label} no puede tener mas de 5 items')
    .required('El campo: ${label}, es Requerido');

export const characteristic4ArrayObjectSchema = Yup.array()
    .label('caracteriztica 4')
    .of(Yup.object().shape(attributeObjectSchema))
    .min(1, 'El ${label} no puede estar vacío')
    .max(5, 'El ${label} no puede tener mas de 5 items')
    .required('El campo: ${label}, es Requerido');

export const compatibilitiesArrayObjectSchema = Yup.array()
    .label('compatibilidades')
    .of(Yup.object().shape(attributeObjectSchema))
    .min(1, 'El ${label} no puede estar vacío')
    .max(5, 'El ${label} no puede tener mas de 5 items')
    .required('El campo: ${label}, es Requerido');

export const includeArrayObjectSchema = Yup.array()
    .label('incluye')
    .of(Yup.object().shape(attributeObjectSchema))
    .min(1, 'El ${label} no puede estar vacío')
    .max(5, 'El ${label} no puede tener mas de 5 items')
    .required('El campo: ${label}, es Requerido');

export const noIncludeArrayObjectSchema = Yup.array()
    .label('no incluye')
    .of(Yup.object().shape(attributeObjectSchema))
    .min(1, 'El ${label} no puede estar vacío')
    .max(5, 'El ${label} no puede tener mas de 5 items')
    .required('El campo: ${label}, es Requerido');
