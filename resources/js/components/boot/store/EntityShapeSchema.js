import * as yup from 'yup';
import { stringSchema, objectShapeSchema } from '../../../utils/yupCommon';

const address = yup.object().shape({
    country: objectShapeSchema.label('pais').required(),
    street: stringSchema.label('nombre').max(200).required(),
    state: objectShapeSchema.label('estado').required(),
    municipality: objectShapeSchema.label('municipio').required(),
    neighbourhood: objectShapeSchema.label('colonia').required(),
    ext: stringSchema.label('numero exterior').min(1).max(200).required(),
    reference: stringSchema.label('referencia').max(200).required(),
    postal_code: stringSchema.label('codigo postal').max(200).required(),
});

export const EntityShapeSchema = yup.object().shape({
    rfc: stringSchema.label('RFC').max(13).required(),
    first_phone:stringSchema.label('Telefono').matches(/^[0-9]{8,10}$/g, 'El código ${label}  debe tener 8 - 10 números').required(),
    second_phone:stringSchema.label('Telefono alternativo').matches(/^[0-9]{8,10}$/g, 'El código ${label}  debe tener 8 - 10 números').nullable(),
    business_name: stringSchema.label('nombre del negocio').max(200).required(),
    tax_regime: objectShapeSchema.label('regimen fiscal').required(),
    email: stringSchema.label('email').email('Ingresa un correo electrónico válido').max(200).required(),
    address: address,
});

const rfcRegExp = /^[a-zA-Z]{3,4}(\d{6})((\D|\d){2,3})?$/;
export const EntitySearchShapeSchema = yup.object().shape({
    rfc: stringSchema.label('RFC').max(13).matches(rfcRegExp).required(),
});
