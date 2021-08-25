export interface Lk {
  id: string;
  firstname: string;
  lastname: string;
  middle_name: string;
  email: string;
  phone: string;
  otherphone: string;
  attendant_gender: string;
  media: string;
  child1: include;
  child2: include;
  child3: include;
  child4: include;
}

interface include {
  name: string;
  url: string;
}