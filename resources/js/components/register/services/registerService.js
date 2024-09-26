import axiosClient from "@/utils/axiosClient.js";

export const signUpService = async (params) => {
  return await axiosClient.post("/cliente/registro", params);
}

