export interface Trips {     
    id: string;
    name: string;
    where_address: string;
    date: string;
    time: string;
    status: string;    
}

export interface Trip {
  name: string;
  where_address: string;
  date: string;
  time: string;
  status: string;
  childrens: number;
  parking_fee: number;
  child1: include;
  child2: include;
  child3: include;
  child4: include;
  attendant: include;
  schedule: include;
  scheduled_wait_where: number;
  scheduled_wait_from: number;
}

interface include {
  name: string;
  url: string;
}