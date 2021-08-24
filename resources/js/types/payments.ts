export interface Payments {
  pay_date: string;
  amount: number;
  spstatus: string;
}

export interface Payment {
  pay_date: string;
  amount: number;
  spstatus: string;
  type_payment: string;
}