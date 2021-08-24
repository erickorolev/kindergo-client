export interface Schedules {
  id: string;
  name: string;
  where_address: string;
  trips: number;
  status: string;
}

export interface Schedule {
  name: string;
  where_address: string;
  trips: number;
  children: number;
  status: string;
  time: string;
  date: string;
  bill_paid: string;
  childrens_age: string;
  child1: include;
  child2: include;
  child3: include;
  child4: include;
  description: string;
  parking_info: string;
  duration: number;
  distance: number;
  scheduled_wait_from: number;
  scheduled_wait_where: number;
  number_insurance: number;
}

interface include {
  name: string;
  url: string;
}