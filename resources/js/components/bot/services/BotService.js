import axiosClient from "@/utils/axiosClient.js";

export const findRegisterBotAllService = async (params = null) => {
  const param = {
    params: params,
};
  return await axiosClient.get('bots',param);
};

export const findRegisterBotByIdService= async (params) => {
    const param = {
      params: params,
  };
  return await axiosClient.get("bot", param);
};

export const findPostalCodeService = async (params) => {
  const param = {
      params: params,
  };
  return await axiosClient.get('colonia/codigo_postal', param);
};

export const storeRegisterBotService = async (params) => {
  return await axiosClient.post('bot', params);
};

export const updateRegisterBotService = async (params) => {
  return await axiosClient.put('bot', params);
};

export const findRegisterBotByNameService = async (params) => {
  const param = {
      params: params,
  };
  return await axiosClient.get('bot/nombre', param);
};
