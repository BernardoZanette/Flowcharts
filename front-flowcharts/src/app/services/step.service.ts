import { Injectable } from '@angular/core';
import { mainEnvironment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';

export interface StepResponse {
  "id": number
  "title": string
  "flowchartId": number
}

@Injectable({
  providedIn: 'root'
})
export class StepService {

  public base: string = mainEnvironment.SERVER_URL + "steps";

  constructor(private httpClient: HttpClient) {}

  public getStepsByFlowchartId(flowchartId: number): Promise<any> {
    const promise: Promise<any> = new Promise((resolve: any, reject: any) => {
      this.httpClient.get(`${this.base}/flowchart/${flowchartId}`).subscribe(
        (response: any) => resolve(response),
        (error: any) => reject(error)
      );
    })
    return promise;
  }

  public createStep(stepData: object): Promise<any> {
    const promise: Promise<any> = new Promise((resolve: any, reject: any) => {
      this.httpClient.post(`${this.base}`, stepData).subscribe(
        (response: any) => resolve(response),
        (error: any) => reject(error)
      );
    })
    return promise;
  }

  public removeStep(stepId: number): Promise<any> {
    const promise: Promise<any> = new Promise((resolve: any, reject: any) => {
      this.httpClient.delete(`${this.base}/${stepId}`).subscribe(
        (response: any) => resolve(response),
        (error: any) => reject(error)
      );
    })
    return promise;
  }
}
