import * as yup from 'yup';
import { stringSchema, objectShapeSchema, flowSchema } from '../../../utils/yupCommon';

export const BotShapeSchema = yup.object().shape({
    name: stringSchema.label('Nombre').max(50).required(),
    content: stringSchema.label('descricion').max(200).required(),
    telegram_bot: stringSchema.label('telegram_bot').max(50).required(),
    whatsapp_number: stringSchema.label('whatsapp_number').max(50).required(),
    language: objectShapeSchema.label('Lenguaje').required(),
    start_message: stringSchema.label('Mensaje de inicio').max(200).required(),
    flows: flowSchema,
});

export const BotSearchShapeSchema = yup.object().shape({
    flow_name:  stringSchema.label('Nombre').max(50).required(),
    flow_description:  stringSchema.label('Nombre').max(50).required(),
});
