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


export const storeRegisterBotService = async (params) => {
  return await axiosClient.post('bot', params);
};

export const updateRegisterBotService = async (params) => {
  return await axiosClient.put('bot', params);
};

export const turnOnOrOffRegisterBotService = async(params) =>{
   return await axiosClient.put('bot/activar', params);
}
export const deleteRegisterBotService = async(params)=>{
    const param = {
      params: params,
  };
  return await axiosClient.delete('bot/eliminar', param);
}

export const findRegisterBotByNameService = async (params) => {
  const param = {
      params: params,
  };
  return await axiosClient.get("bot", param);
};
