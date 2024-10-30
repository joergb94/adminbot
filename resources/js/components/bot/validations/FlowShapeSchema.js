import * as yup from 'yup';
import { stringSchema, objectShapeSchema, flowSchema } from '../../../utils/yupCommon';

export const FlowShapeSchema = yup.object().shape({
    flow_name: stringSchema.label('nombre del flujo').max(50).required(),
    flow_description: stringSchema.label('descripcion del flujo').max(200).required(),
    flow_sort: stringSchema.label('ordenamiento del flujo').max(50).required(),
});
