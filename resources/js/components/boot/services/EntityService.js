import axiosClient from "@/utils/axiosClient.js";

export const findRegisterEntityAllService = async (params = null) => {
  const param = {
    params: params,
};
  return await axiosClient.get('cliente/empresas',param);
};

export const findRegisterEntityByIdService= async (params) => {
    const param = {
      params: params,
  };
  return await axiosClient.get("cliente/empresa", param);
};

export const findPostalCodeService = async (params) => {
  const param = {
      params: params,
  };
  return await axiosClient.get('colonia/codigo_postal', param);
};

export const storeRegisterEntityService = async (params) => {
  return await axiosClient.post('cliente/empresa', params);
};

export const updateRegisterEntityService = async (params) => {
  return await axiosClient.put('cliente/empresa', params);
};

export const findRegisterEntityByRFCService = async (params) => {
  const param = {
      params: params,
  };
  return await axiosClient.get('cliente/empresa/rfc', param);
};
