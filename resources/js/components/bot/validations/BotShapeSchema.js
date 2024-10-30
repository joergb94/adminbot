import * as yup from 'yup';
import { stringSchema, objectShapeSchema, flowSchema } from '../../../utils/yupCommon';

export const BotShapeSchema = yup.object().shape({
    name: stringSchema.label('Nombre').max(50).required(),
    description: stringSchema.label('descricion').max(500).required(),
    content: stringSchema.label('contenido del bot').max(2500).required(),
    telegram_bot: stringSchema.label('telegram_bot').max(50).required(),
    whatsapp_number: stringSchema.label('whatsapp_number').max(50).required(),
    language: objectShapeSchema.label('Lenguaje').required(),
    start_message: stringSchema.label('Mensaje de inicio').nullable().min(5).max(200),
    flows: flowSchema,
});
