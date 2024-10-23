import * as yup from 'yup';
import { stringSchema, objectShapeSchema, flowSchema } from '../../../utils/yupCommon';

export const FlowShapeSchema = yup.object().shape({
    name: stringSchema.label('nombre').max(50).required(),
    description: stringSchema.label('descripcion').max(200).required(),
    sort: stringSchema.label('ordenamiento').max(50).required(),
});
