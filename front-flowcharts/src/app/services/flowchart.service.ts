import { Injectable } from '@angular/core';
import { mainEnvironment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';

export interface FlowchartResponse {
  "id": number
  "title": string
  "flowchartId": number
  "stepParentIds": []
}

@Injectable({
  providedIn: 'root'
})

export class FlowchartService {

  public base: string = mainEnvironment.SERVER_URL + "flowcharts";

  constructor(private httpClient: HttpClient) {}

  public getStructure(flowchartId : number): Promise<any> {
    const promise: Promise<any> = new Promise((resolve: any, reject: any) => {
      this.httpClient.get(`${this.base}/${flowchartId}/structure`).subscribe(
        (response: any) => resolve(response),
        (error: any) => reject(error)
      );
    })
    return promise;
  }

  public getFlowcharts(): Promise<any> {
    const promise: Promise<any> = new Promise((resolve: any, reject: any) => {
      this.httpClient.get(`${this.base}`).subscribe(
        (response: any) => resolve(response),
        (error: any) => reject(error)
      );
    })
    return promise;
  }

}
