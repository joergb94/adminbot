import axiosClient from "@/utils/axiosClient.js";

export const signInService = async (params) => {
  return await axiosClient.post("/cliente/entrar", params);
};

